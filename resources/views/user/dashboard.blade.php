@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2 class="mb-3">User Dashboard</h2>
    <p class="text-muted">Welcome back, <strong>{{ auth()->user()->name ?? 'Guest' }}</strong></p>

    <div class="row mt-4">

        <!-- My Orders -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    My Orders
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <p>No orders placed yet.</p>
                    @else
                        <ul class="list-group">
                            @foreach($orders as $order)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $order->book->title ?? 'Book deleted' }}
                                    <span class="badge {{ $order->status=='completed' ? 'bg-success' : ($order->status=='pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        
        <!-- My Downloads / Subscribed Books -->
<div class="col-md-6 mb-4">
    <div class="card shadow-sm h-100">
        <div class="card-header bg-success text-white">
            My Subscriptions
        </div>
        <div class="card-body">
            @if($subscriptions->isEmpty())
                <p>No books subscribed yet.</p>
            @else
                <ul class="list-group">
                    @foreach($subscriptions as $subscription)
                        <li class="list-group-item d-flex flex-column mb-2">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>{{ $subscription->book->title }}</strong>
                                <span class="badge {{ $subscription->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($subscription->status) }}
                                </span>
                            </div>

                            <div class="d-flex gap-2">
                                <!-- Go to Book Details -->
                                <a href="{{ route('book.show', $subscription->book->id) }}" class="btn btn-outline-primary w-50">
                                    View Details
                                </a>

                                <!-- Read PDF if Active -->
                                @if($subscription->status == 'active')
                                    <a href="{{ route('book.free.read', $subscription->book->id) }}" class="btn btn-success w-50">
                                        Read Now
                                    </a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

    </div>



@endsection
