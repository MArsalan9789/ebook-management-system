{{-- @extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Edit Order</h3>

    <form action="{{ route('orderupdate',$order->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ $order->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Book</label>
            <select name="book_id" class="form-control">
                @foreach($books as $book)
                    <option value="{{ $book->id }}"
                        {{ $order->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" value="{{ $order->price }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                <option value="paid" {{ $order->status=='paid'?'selected':'' }}>Paid</option>
                <option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>Cancelled</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('orderlist') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection --}}
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Edit Order</h3>

    <form action="{{ route('orderupdate', $order->id) }}" method="POST">
        @csrf

        {{-- User select --}}
        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ $order->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Book select --}}
        <div class="mb-3">
            <label>Book</label>
            <select name="book_id" class="form-control">
                @foreach($books as $book)
                    <option value="{{ $book->id }}"
                        {{ $order->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Price input --}}
        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" value="{{ $order->price }}" class="form-control">
        </div>

        {{-- Status select --}}
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        {{-- Buttons --}}
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('orderlist') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

