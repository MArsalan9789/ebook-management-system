<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function userindex()
    {
        $userId = auth()->id();
        $totalBooks = Book::count(); // Total books in system (optional)
        $orders = Order::where('user_id', $userId)->get(); // Orders of logged-in user
        $subscriptions = Subscription::where('user_id', $userId)->get(); // Subscriptions of logged-in user
        return view('user.dashboard', compact('totalBooks', 'orders', 'subscriptions'));
    }

    public function myBooks()
{
    $books = Book::whereHas('orders', function ($q) {
        $q->where('user_id', auth()->id())
          ->where('status', 'paid');
    })->get();

    return view('user.my_books', compact('books'));
}

    public function search(Request $request)
    {
        $q = $request->q;

        $category = $request->category;

        $books = Book::where('title', 'like', "%$q%")->orWhere('author', 'like', "%$q%")->get();

        return view('user.books', compact('books'));
    }
    public function home()
    {
        $newBooks = Book::latest()->take(8)->get();
        return view('user.welcome', compact('newBooks'));
    }
}
