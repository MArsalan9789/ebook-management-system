<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Order;

class CartController extends Controller
{
    // Show Cart
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(fn($i) => $i['price'], $cart));
        return view('user.cart', compact('cart', 'total'));
    }

    // Add Item to Cart
    public function add(Request $request, $id)
    {
        $request->validate(['format' => 'required|in:pdf,cd,hardcopy']);

        $book = Book::findOrFail($id);
        $cart = session()->get('cart', []);
        $cart[] = [
            'book_id' => $book->id,
            'title'   => $book->title,
            'format'  => $request->format,
            'price'   => $book->price,
        ];
        session()->put('cart', $cart);
        session()->put('cart_count', count($cart));

        return redirect()->route('cart')->with('success', 'Item cart mein add ho gaya.');
    }

    // Remove Item from Cart
    public function remove($key)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$key])) {
            unset($cart[$key]);
            $cart = array_values($cart); // Reindex
            session()->put('cart', $cart);
            session()->put('cart_count', count($cart));
        }
        return redirect()->route('cart')->with('success', 'Item remove ho gaya.');
    }

    // Checkout / Place Order
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Cart khali hai.');
        }

        // Loop through each cart item and create order
        foreach ($cart as $item) {
            Order::create([
                'user_id' => auth()->id(),
                'book_id' => $item['book_id'],
                'price'   => $item['price'],
                'format'  => $item['format'],
                'status'  => 'pending',
            ]);
        }

        // Clear cart session
        session()->forget('cart');
        session()->forget('cart_count');

        return redirect()->route('userdashboard')->with('success', 'Order place ho gaya!');
    }
}
