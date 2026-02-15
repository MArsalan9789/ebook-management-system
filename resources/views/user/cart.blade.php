@extends('layouts.user')

@section('content')
<h2>Your Cart</h2>
<table class="table">
    <tr><th>Book</th><th>Format</th><th>Price</th><th>Action</th></tr>
    @foreach($cart as $i => $item)
    <tr>
        <td>{{ $item['title'] }}</td>
        <td>{{ strtoupper($item['format']) }}</td>
        <td>{{ $item['price'] }}</td>
        <td><a href="{{ route('cart.remove',$i) }}" class="btn btn-danger btn-sm">Remove</a></td>
    </tr>
    @endforeach
</table>
<h4>Total: {{ $total }}</h4>
<form method="POST" action="{{ route('checkout') }}">
    @csrf
    <button class="btn btn-success">Order Confirm</button>
</form>
@endsection
