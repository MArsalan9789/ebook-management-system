@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">

        {{-- Page Header --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">📦 Orders Management</h4>
            <a href="{{ route('ordercreate') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Order
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Orders Table --}}
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light text-center">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Book</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th width="300">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'Guest' }}</td>
                                <td>{{ $order->book->title ?? '-' }}</td>
                                <td><strong>Rs {{ number_format($order->price) }}</strong></td>
                                <td>
                                    <span
                                        class="badge rounded-pill
                                    @if ($order->status == 'paid') bg-success
                                    @elseif($order->status == 'cancelled') bg-danger
                                    @else bg-warning text-dark @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        {{-- View --}}
                                        <a href="{{ route('orderview', $order->id) }}" class="btn btn-info">View</a>

                                        {{-- Edit --}}
                                        <a href="#" data-url="{{ route('orderedit', $order->id) }}"
                                            class="btn btn-warning js-edit">Edit</a>

                                        {{-- Paid --}}
                                        {{-- @if ($order->status != 'paid')
                                        <form action="{{ route('order.status', [$order->id, 'paid']) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="button" class="btn btn-success btn-sm js-paid">Paid</button>
                                        </form>
                                    @endif --}}

                                        {{-- Cancel --}}
                                        @if ($order->status != 'cancelled')
                                            <form action="{{ route('order.status', [$order->id, 'cancelled']) }}"
                                                method="get" class="d-inline">
                                                @csrf
                                                <button type="button"
                                                    class="btn btn-danger btn-sm js-cancel">Cancel</button>
                                            </form>
                                        @endif
                                    </div>

                                    {{-- Delete --}}
                                    <form action="{{ route('orderdelete', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-dark btn-sm js-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted py-4">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    @if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endsection
