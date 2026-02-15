<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // LIST ORDERS
    public function index()
    {
        $orders = Order::with(['user', 'book'])->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // CREATE FORM
    public function create()
    {
        $users = User::all();
        $books = Book::all();
        return view('admin.orders.create', compact('users', 'books'));
    }

    // STORE ORDER
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'price' => 'required|numeric',
            'status' => 'required'
        ]);

        Order::create($request->all());

        return redirect()->route('orderlist')
            ->with('success', 'Order created successfully');
    }

    // SHOW ORDER
    public function show($id)
    {
        $order = Order::with(['user', 'book'])->findOrFail($id);
        return view('admin.orders.view', compact('order'));
    }

    // EDIT FORM
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = User::all();
        $books = Book::all();
        return view('admin.orders.edit', compact('order', 'users', 'books'));
    }

    // UPDATE ORDER
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'price' => 'required|numeric',
            'status' => 'required'
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('orderlist')
            ->with('success', 'Order updated successfully');
    }

    // DELETE ORDER
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();

        return redirect()->route('orderlist')
            ->with('success', 'Order deleted successfully');
    }
    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:paid,cancelled,pending'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    }
}
