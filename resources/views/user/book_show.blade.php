@extends('layouts.user')

@section('content')
<div class="container py-5">
    <div class="row g-4">

        <!-- Book Cover -->
        <div class="col-md-4 text-center">
            <div class="card shadow-sm border-0">
                <img src="{{ $book->cover ? asset('storage/'.$book->cover) : asset('images/default.png') }}"
                     class="img-fluid rounded-top" alt="{{ $book->title }}">
            </div>
        </div>

        <!-- Book Details -->
        <div class="col-md-8">
            <h2 class="fw-bold">{{ $book->title }}</h2>
            <p class="text-muted mb-2"><strong>Author:</strong> {{ $book->author ?? 'Unknown Author' }}</p>
            @if($book->description)
                <p>{{ $book->description }}</p>
            @endif

            <!-- Price -->
            <p class="mb-3">
                <strong>Price:</strong>
                @if($book->is_free)
                    <span class="badge bg-success">FREE</span>
                @else
                    <span class="text-primary fw-bold">Rs {{ number_format($book->price, 2) }}</span>
                @endif
            </p>

            <!-- Preview File -->
            @if($book->preview_file)
                <a href="{{ asset('storage/'.$book->preview_file) }}" target="_blank"
                   class="btn btn-outline-primary mb-3">
                   📖 Preview Book
                </a>
            @endif

            <!-- Free Download / Buy / Subscribe -->
            <div class="d-grid gap-2">
                @if($book->is_free)
                    <a href="{{ route('book.free.download',$book->id) }}" class="btn btn-success">
                        ⬇ Download Free
                    </a>
                @else
                    <!-- Add to Cart -->
                    <form method="POST" action="{{ route('cart.add',$book->id) }}">
                        @csrf
                        <select name="format" class="form-select mb-2">
                            <option value="pdf">PDF</option>
                            <option value="cd">CD</option>
                            <option value="hardcopy">Hard Copy</option>
                        </select>
                        <button type="submit" class="btn btn-warning mb-2">🛒 Buy / Add to Cart</button>
                    </form>

                    <!-- Subscription -->
                    <form method="POST" action="{{ route('subscribe',$book->id) }}">
                        @csrf
                        <select name="term" class="form-select mb-2">
                            <option value="1">1 Year</option>
                            <option value="2">2 Years</option>
                            <option value="3">3 Years</option>
                        </select>
                        <button type="submit" class="btn btn-primary">📅 Subscribe</button>
                    </form>
                @endif
            </div>
        </div>

    </div>
</div>

<style>
    .card img {
        max-height: 400px;
        object-fit: cover;
    }

    .btn {
        border-radius: 6px;
    }
</style>
@endsection
