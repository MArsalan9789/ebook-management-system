<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Competition;
use App\Models\Order;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    // ======================
    // ADMIN DASHBOARD
    // ======================
    public function adminindex()
    {
        // USERS COUNTS
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalNormalUsers = User::where('role', 'user')->count();

        // BOOKS & ORDERS
        $totalBooks  = Book::count();
        $totalOrders = Order::count();

        // REVENUE
        $totalRevenue = Order::where('status', 'paid')->sum('price');

        // ORDERS PER MONTH
        $ordersPerMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        // USERS PER MONTH (last 6 months)
        $usersPerMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->pluck('total', 'month');

        // COMPETITIONS COUNT
        $totalCompetitions = Competition::count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalNormalUsers',
            'totalBooks',
            'totalOrders',
            'totalRevenue',
            'ordersPerMonth',
            'usersPerMonth',
            'totalCompetitions'
        ));
    }

    // ======================
    // USERS CRUD
    // ======================
    public function fatchuser()
    {
        $user = User::all();
        return view('admin.alluser', ['alluser' => $user]);
    }

    public function deleteuser($id)
    {
        $result = User::destroy($id);
        if ($result) {
            return redirect()->route('alluser')->with("success", "User deleted successfully");
        }
        return redirect()->route('alluser');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edituser', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::findOrFail($id);
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;
        $user->save();

        return redirect()->route('alluser')->with('success', 'User updated successfully!');
    }

    // ======================
    // BOOKS CRUD
    // ======================
    public function createBook()
    {
        return view('admin.createbook');
    }

    public function storeBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'file' => 'nullable|mimes:pdf|max:2048',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->only('title', 'author', 'price', 'category', 'status');

        // File upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('books', $filename, 'public');
            $data['file'] = 'books/' . $filename;
        }
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $covername = time() . '_' . $cover->getClientOriginalName();
            $cover->storeAs('covers', $covername, 'public');
            $data['cover'] = 'covers/' . $covername;
        }

        Book::create($data);

        return redirect()->route('admindashboard')->with('success', 'Book added successfully!');
    }

    public function bookList()
    {
        $books = Book::all();
        return view('admin.booklist', compact('books'));
    }

    public function editBook($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.editbook', compact('book'));
    }

    public function updateBook(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'status' => 'required|string',
            'file' => 'nullable|mimes:pdf|max:2048',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'preview_file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only('title', 'author', 'category', 'status', 'price');
        $data['is_free'] = $request->input('is_free', 0);

        // ✅ Cover image
        if ($request->hasFile('cover')) {
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }

            $covername = time() . '_' . $request->file('cover')->getClientOriginalName();
            $request->file('cover')->storeAs('covers', $covername, 'public');
            $data['cover'] = 'covers/' . $covername;
        }

        // ✅ Main PDF
        if ($request->hasFile('file')) {
            if ($book->file && Storage::disk('public')->exists($book->file)) {
                Storage::disk('public')->delete($book->file);
            }

            $filename = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('books', $filename, 'public');
            $data['file'] = 'books/' . $filename;
        }

        // ✅ Preview PDF
        if ($request->hasFile('preview_file')) {
            if ($book->preview_file && Storage::disk('public')->exists($book->preview_file)) {
                Storage::disk('public')->delete($book->preview_file);
            }

            $previewname = time() . '_' . $request->file('preview_file')->getClientOriginalName();
            $request->file('preview_file')->storeAs('previews', $previewname, 'public');
            $data['preview_file'] = 'previews/' . $previewname;
        }

        $book->update($data);

        return redirect()->route('booklist')->with('success', 'Book updated successfully!');
    }


   public function deleteBook($id)
{
    $book = Book::findOrFail($id);

    if ($book->file && Storage::disk('public')->exists($book->file)) {
        Storage::disk('public')->delete($book->file);
    }

    if ($book->cover && Storage::disk('public')->exists($book->cover)) {
        Storage::disk('public')->delete($book->cover);
    }

    if ($book->preview_file && Storage::disk('public')->exists($book->preview_file)) {
        Storage::disk('public')->delete($book->preview_file);
    }

    $book->delete();

    return redirect()->route('booklist')->with('success', 'Book deleted successfully!');
}
}
