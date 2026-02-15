<div class="col-md-3 col-sm-6 mb-4">
    <div class="card shadow-sm h-100 book-card position-relative overflow-hidden">

        <img src="{{ $book->cover ? asset('storage/'.$book->cover) : asset('images/default.png') }}"
             alt="{{ $book->title }}"
             class="card-img-top book-cover">

        {{-- Overlay --}}
        <div class="card-overlay d-flex flex-column justify-content-center align-items-center">
            <a href="{{ route('book.show', $book) }}"
               class="btn btn-primary mb-2 w-75">
                View Details
            </a>

            @if(!$book->is_free)
                <form method="POST" action="{{ route('cart.add', $book) }}" class="w-75">
                    @csrf
                    <button class="btn btn-success w-100">Add to Cart</button>
                </form>
            @else
                <a href="{{ route('book.free.download', $book) }}"
                   class="btn btn-success w-75">
                    Download Free
                </a>
            @endif
        </div>

        <div class="card-body text-center">
            <h5 class="fw-bold">{{ $book->title }}</h5>
            <p class="text-muted mb-1">{{ $book->author }}</p>
            <p class="fw-bold text-primary">
                {{ $book->is_free ? 'Free' : 'Rs '.$book->price }}
            </p>
        </div>

    </div>
</div>
