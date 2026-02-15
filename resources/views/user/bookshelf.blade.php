@extends('layouts.user')
@section('content')
    <section id="popular-books" class="bookshelf py-5 my-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!-- Section Header -->
                    <div class="section-header align-center">
                        <div class="title">
                            <span>Some quality items</span>
                        </div>
                        <h2 class="section-title">Popular Books</h2>
                    </div>

                    <!-- Tabs -->
                    <ul class="tabs">
                        <li data-tab-target="#all-genre" class="active tab">All Genre</li>
                        <li data-tab-target="#business" class="tab">Business</li>
                        <li data-tab-target="#technology" class="tab">Technology</li>
                        <li data-tab-target="#romantic" class="tab">Romantic</li>
                        <li data-tab-target="#adventure" class="tab">Adventure</li>
                        <li data-tab-target="#fictional" class="tab">Fictional</li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content">

                        <!-- All Genre -->
                        <div id="all-genre" data-tab-content class="active">
                            <div class="row">
                                @forelse($allBooks as $book)
                                    <div class="col-md-3 col-sm-6 mb-4">
                                        <div class="card shadow-sm h-100 book-card position-relative overflow-hidden">

                                            <img src="{{ $book->cover ? asset('storage/' . $book->cover) : asset('images/default.png') }}"
                                                alt="{{ $book->title }}" class="card-img-top book-cover">

                                            {{-- Overlay Buttons --}}
                                            <div
                                                class="card-overlay d-flex flex-column justify-content-center align-items-center">
                                                <a href="{{ route('book.show', $book->id) }}"
                                                    class="btn btn-primary mb-2 w-75">
                                                    View Details
                                                </a>

                                                @if (!$book->is_free)
                                                    <form method="POST" action="{{ route('cart.add', $book->id) }}"
                                                        class="w-75">
                                                        @csrf
                                                        <input type="hidden" name="format" value="pdf">
                                                        <button class="btn btn-success w-100">Add to Cart</button>
                                                    </form>
                                                @else
                                                    <a href="{{ route('book.free.download', $book->id) }}"
                                                        class="btn btn-success w-75">
                                                        Download Free
                                                    </a>
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
                        </div>

                        <!-- Business -->
                        <div id="business" data-tab-content>
                            <div class="row">
                                @forelse($businessBooks as $book)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100 book-card position-relative overflow-hidden">

                        <img src="{{ $book->cover ? asset('storage/'.$book->cover) : asset('images/default.png') }}"
                             alt="{{ $book->title }}"
                             class="card-img-top book-cover"
                             >

                        {{-- Overlay Buttons --}}
                        <div class="card-overlay d-flex flex-column justify-content-center align-items-center">
                            <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary mb-2 w-75">
                                View Details
                            </a>

                            @if(!$book->is_free)
                                <form method="POST" action="{{ route('cart.add',$book->id) }}" class="w-75">
                                    @csrf
                                    <input type="hidden" name="format" value="pdf">
                                    <button class="btn btn-success w-100">Add to Cart</button>
                                </form>
                            @else
                                <a href="{{ route('book.free.download',$book->id) }}" class="btn btn-success w-75">
                                    Download Free
                                </a>
                            @endif
                        </div>

                        <div class="card-body text-center">
                            <h5 class="fw-bold">{{ $book->title }}</h5>
                            <p class="text-muted mb-1">{{ $book->author }}</p>
                            <p class="fw-bold text-primary">
                                @if($book->is_free) Free @else Rs {{ $book->price }} @endif
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
                        </div>

                        <!-- Technology -->
                        <div id="technology" data-tab-content>
                            <div class="row">
                                @forelse ($technologyBooks as $book)

                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100 book-card position-relative overflow-hidden">

                        <img src="{{ $book->cover ? asset('storage/'.$book->cover) : asset('images/default.png') }}"
                             alt="{{ $book->title }}"
                             class="card-img-top book-cover"
                             >

                        {{-- Overlay Buttons --}}
                        <div class="card-overlay d-flex flex-column justify-content-center align-items-center">
                            <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary mb-2 w-75">
                                View Details
                            </a>

                            @if(!$book->is_free)
                                <form method="POST" action="{{ route('cart.add',$book->id) }}" class="w-75">
                                    @csrf
                                    <input type="hidden" name="format" value="pdf">
                                    <button class="btn btn-success w-100">Add to Cart</button>
                                </form>
                            @else
                                <a href="{{ route('book.free.download',$book->id) }}" class="btn btn-success w-75">
                                    Download Free
                                </a>
                            @endif
                        </div>

                        <div class="card-body text-center">
                            <h5 class="fw-bold">{{ $book->title }}</h5>
                            <p class="text-muted mb-1">{{ $book->author }}</p>
                            <p class="fw-bold text-primary">
                                @if($book->is_free) Free @else Rs {{ $book->price }} @endif
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
                        </div>

                        <!-- Romantic -->
                        <div id="romantic" data-tab-content>
                            <div class="row">
                                @forelse ($romanticBooks as $book)

                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100 book-card position-relative overflow-hidden">

                        <img src="{{ $book->cover ? asset('storage/'.$book->cover) : asset('images/default.png') }}"
                             alt="{{ $book->title }}"
                             class="card-img-top book-cover"
                             >

                        {{-- Overlay Buttons --}}
                        <div class="card-overlay d-flex flex-column justify-content-center align-items-center">
                            <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary mb-2 w-75">
                                View Details
                            </a>

                            @if(!$book->is_free)
                                <form method="POST" action="{{ route('cart.add',$book->id) }}" class="w-75">
                                    @csrf
                                    <input type="hidden" name="format" value="pdf">
                                    <button class="btn btn-success w-100">Add to Cart</button>
                                </form>
                            @else
                                <a href="{{ route('book.free.download',$book->id) }}" class="btn btn-success w-75">
                                    Download Free
                                </a>
                            @endif
                        </div>

                        <div class="card-body text-center">
                            <h5 class="fw-bold">{{ $book->title }}</h5>
                            <p class="text-muted mb-1">{{ $book->author }}</p>
                            <p class="fw-bold text-primary">
                                @if($book->is_free) Free @else Rs {{ $book->price }} @endif
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
                        </div>

                        <!-- Adventure -->
                        <div id="adventure" data-tab-content>
                            <div class="row">
                                @forelse ($adventureBooks as $book)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100 book-card position-relative overflow-hidden">

                        <img src="{{ $book->cover ? asset('storage/'.$book->cover) : asset('images/default.png') }}"
                             alt="{{ $book->title }}"
                             class="card-img-top book-cover"
                             >

                        {{-- Overlay Buttons --}}
                        <div class="card-overlay d-flex flex-column justify-content-center align-items-center">
                            <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary mb-2 w-75">
                                View Details
                            </a>

                            @if(!$book->is_free)
                                <form method="POST" action="{{ route('cart.add',$book->id) }}" class="w-75">
                                    @csrf
                                    <input type="hidden" name="format" value="pdf">
                                    <button class="btn btn-success w-100">Add to Cart</button>
                                </form>
                            @else
                                <a href="{{ route('book.free.download',$book->id) }}" class="btn btn-success w-75">
                                    Download Free
                                </a>
                            @endif
                        </div>

                        <div class="card-body text-center">
                            <h5 class="fw-bold">{{ $book->title }}</h5>
                            <p class="text-muted mb-1">{{ $book->author }}</p>
                            <p class="fw-bold text-primary">
                                @if($book->is_free) Free @else Rs {{ $book->price }} @endif
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
                        </div>

                        <!-- Fictional -->
                        <div id="fictional" data-tab-content>
                            <div class="row">
                                @forelse ($fictionalBooks as $book)
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card shadow-sm h-100 book-card position-relative overflow-hidden">

                        <img src="{{ $book->cover ? asset('storage/'.$book->cover) : asset('images/default.png') }}"
                             alt="{{ $book->title }}"
                             class="card-img-top book-cover"
                             >

                        {{-- Overlay Buttons --}}
                        <div class="card-overlay d-flex flex-column justify-content-center align-items-center">
                            <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary mb-2 w-75">
                                View Details
                            </a>

                            @if(!$book->is_free)
                                <form method="POST" action="{{ route('cart.add',$book->id) }}" class="w-75">
                                    @csrf
                                    <input type="hidden" name="format" value="pdf">
                                    <button class="btn btn-success w-100">Add to Cart</button>
                                </form>
                            @else
                                <a href="{{ route('book.free.download',$book->id) }}" class="btn btn-success w-75">
                                    Download Free
                                </a>
                            @endif
                        </div>

                        <div class="card-body text-center">
                            <h5 class="fw-bold">{{ $book->title }}</h5>
                            <p class="text-muted mb-1">{{ $book->author }}</p>
                            <p class="fw-bold text-primary">
                                @if($book->is_free) Free @else Rs {{ $book->price }} @endif
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
                        </div>

                    </div><!-- tab-content -->

                </div><!-- col-md-12 -->
            </div><!-- row -->
        </div><!-- container -->
    </section>
@endsection
