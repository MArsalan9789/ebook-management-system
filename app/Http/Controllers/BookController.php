<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Subscription;

class BookController extends Controller
{
    // Shop page
    public function index()
    {
        $books = Book::all();
        return view('user.books', compact('books'));
    }

    // Single book details
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('user.book_show', compact('book'));
    }

    // Subscription system
    public function subscribe(Request $request, $id)
    {
        $request->validate(['term' => 'required|in:1,2,3']);

        Subscription::create([
            'user_id' => auth()->id(),
            'book_id' => $id,
            'term' => $request->term,
            'status' => 'active',
        ]);

        return redirect()->route('userdashboard')->with('success', 'Subscription start ho gayi!');
    }

    public function store(Request $request)
    {
        $data = $request->all();


        if ($request->hasFile('preview_file')) {
            $data['preview_file'] = $request->file('preview_file')->store('previews', 'public');
        }




        Book::create($data);

        return redirect()->route('booklist')->with('success', 'Book added successfully!');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $data = $request->all();

        $data['is_free'] = $request->input('is_free', 0);


        if ($request->hasFile('preview_file')) {
            $data['preview_file'] = $request->file('preview_file')->store('previews', 'public');
        }




        $book->update($data);

        return redirect()->route('booklist')->with('success', 'Book updated successfully!');
    }

    public function freeDownload($id)
    {
        $book = Book::findOrFail($id);

        if (!$book->is_free) {
            return redirect()->back()->with('error', 'This book is not free!');
        }

        $file = storage_path('app/public/' . $book->file); // File path in storage

        if (!file_exists($file)) {
            return redirect()->back()->with('error', 'File not found!');
        }

        return response()->download($file, $book->title . '.pdf');
    }

    // User frontend books page with categories
    public function bookshelf()
    {
        // Fetch all books
        $allBooks = Book::all();

        // Fetch by categories
        $businessBooks   = Book::where('category', 'Business')->get();
        $technologyBooks = Book::where('category', 'Technology')->get();
        $romanticBooks   = Book::where('category', 'Romantic')->get();
        $adventureBooks  = Book::where('category', 'Adventure')->get();
        $fictionalBooks  = Book::where('category', 'Fictional')->get();

        return view('user.bookshelf', compact(
            'allBooks',
            'businessBooks',
            'technologyBooks',
            'romanticBooks',
            'adventureBooks',
            'fictionalBooks'
        ));
    }

    public function readFree($id)
    {
        $book = Book::findOrFail($id);
        $user = auth()->user();

        // Check if book is free OR user has active subscription
        $hasAccess = $book->is_free || ($user && $user->subscriptions()->where('book_id', $book->id)->where('status', 'active')->exists());

        if (!$hasAccess) {
            return redirect()->back()->with('error', 'You do not have access to read this book.');
        }

        $filePath = storage_path('app/public/' . $book->file);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return response()->file($filePath); // Open PDF in browser
    }
}
