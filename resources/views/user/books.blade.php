@extends('layouts.user')

@section('content')
    <div class="container py-5">



        <!-- Books Grid -->
        @if ($books->isEmpty())
            <div class="alert alert-info text-center">
                No books available at the moment.
            </div>
        @else
            <div class="row g-4">
                @forelse ($books as $book)

                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm h-100 book-card position-relative overflow-hidden">

                            <img src="{{ $book->cover ? asset('storage/' . $book->cover) : asset('images/default.png') }}"
                                alt="{{ $book->title }}" class="card-img-top book-cover">

                            {{-- Overlay Buttons --}}
                            <div class="card-overlay d-flex flex-column justify-content-center align-items-center">
                                <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary mb-2 w-75">
                                    View Details
                                </a>

                                @if ($book->is_free)
                                    <a href="{{ route('book.free.read', $book->id) }}" class="btn btn-success w-100">
                                        Read Now
                                    </a>
                                    <a href="{{ route('book.free.download',$book->id) }}" class="btn btn-success w-75">
                                    Download Free
                                </a>
                                @else
                                    <form method="POST" action="{{ route('cart.add', $book->id) }}" class="w-75">
                                        @csrf
                                        <input type="hidden" name="format" value="pdf">
                                        <button class="btn btn-primary w-100">Add to Cart</button>
                                    </form>
                                @endif

                            </div>

                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ $book->title }}</h5>
                                <p class="text-muted mb-1">{{ $book->author }}</p>
                                <p class="fw-bold text-primary">
                                    @if ($book->is_free)
                                        Free
                                    @else
                                        Rs {{ $book->price }}
                                    @endif
                                </p>
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-md-12 text-center">
                        <p>No books available.</p>
                    </div>
                @endforelse

            </div>
        @endif

    </div>

    <style>
        .card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        .book-cover {
            border-radius: 5px;
        }
    </style>
@endsection
