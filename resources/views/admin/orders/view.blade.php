@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Order Details</h3>

    <table class="table table-bordered">
        <tr>
            <th>Order ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>User</th>
            <td>{{ $order->user->name }}</td>
        </tr>
        <tr>
            <th>Book</th>
            <td>{{ $order->book->title }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>Rs {{ $order->price }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($order->status) }}</td>
        </tr>
        <tr>
            <th>Order Date</th>
            <td>{{ $order->created_at->format('d M Y') }}</td>
        </tr>
    </table>

    <a href="{{ route('orderlist') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
