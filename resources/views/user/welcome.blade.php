    @extends('layouts.user')

@section('content')
    <section id="billboard">

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <button class="prev slick-arrow">
                        <i class="icon icon-arrow-left"></i>
                    </button>

                    <div class="main-slider pattern-overlay">
                        <div class="slider-item">
                            <div class="banner-content">
                                <h2 class="banner-title">Life of the Wild</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero
                                    ipsum enim pharetra hac. Urna commodo, lacus ut magna velit eleifend. Amet, quis
                                    urna, a eu.</p>
                                <div class="btn-wrap">
                                    <a href="{{route('bookshelf')}}" class="btn btn-outline-accent btn-accent-arrow">Read More<i
                                            class="icon icon-ns-arrow-right"></i></a>
                                </div>
                            </div><!--banner-content-->
                            <img src="{{ asset('assets/frontend/images/main-banner1.jpg') }}" alt="banner"
                                class="banner-image">
                        </div><!--slider-item-->

                        <div class="slider-item">
                            <div class="banner-content">
                                <h2 class="banner-title">Birds gonna be Happy</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet, libero
                                    ipsum enim pharetra hac. Urna commodo, lacus ut magna velit eleifend. Amet, quis
                                    urna, a eu.</p>
                                <div class="btn-wrap">
                                    <a href="{{route('bookshelf')}}" class="btn btn-outline-accent btn-accent-arrow">Read More<i
                                            class="icon icon-ns-arrow-right"></i></a>
                                </div>
                            </div><!--banner-content-->
                            <img src="{{ asset('assets/frontend/images/main-banner2.jpg') }}" alt="banner"
                                class="banner-image">
                        </div><!--slider-item-->

                    </div><!--slider-->

                    <button class="next slick-arrow">
                        <i class="icon icon-arrow-right"></i>
                    </button>

                </div>
            </div>
        </div>

    </section>



    {{-- ================= ALL BOOKS SECTION ================= --}}
    <section id="all-books" class="bookshelf py-5 my-5">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="section-header align-center">
                        <div class="title">
                            <span>Explore Collection</span>
                        </div>
                        <h2 class="section-title">All Books</h2>
                    </div>
                </div>

                @forelse($newBooks as $book)
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
        </div>
    </section>
    {{-- ================= END ALL BOOKS ================= --}}


    <section id="best-selling" class="leaf-pattern-overlay">
        <div class="corner-pattern-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8">

                    <div class="row">

                        <div class="col-md-6">
                            <figure class="products-thumb">
                                <img src="{{ asset('assets/frontend/images/single-image.jpg') }}" alt="book"
                                    class="single-image">
                            </figure>
                        </div>

                        <div class="col-md-6">
                            <div class="product-entry">
                                <h2 class="section-title divider">Best Selling Book</h2>

                                <div class="products-content">
                                    <div class="author-name">By Timbur Hood</div>
                                    <h3 class="item-title">Birds gonna be happy</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu feugiat amet,
                                        libero ipsum enim pharetra hac.</p>
                                    <div class="item-price">7000.00</div>
                                    <div class="btn-wrap">
                                        <a href="{{route('bookshelf')}}" class="btn-accent-arrow">shop it now <i
                                                class="icon icon-ns-arrow-right"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- / row -->

                </div>

            </div>
        </div>
    </section>

    <section id="download-app" class="leaf-pattern-overlay">
        <div class="corner-pattern-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">

                        <div class="col-md-5">
                            <figure>
                                <img src="assets/frontend/images/device.png" alt="phone" class="single-image">
                            </figure>
                        </div>

                        <div class="col-md-7">
                            <div class="app-info">
                                <h2 class="section-title divider">Download our app !As Soon</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus
                                    liberolectus nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna.
                                    Adipiscing fames semper erat ac in suspendisse iaculis.</p>
                                <div class="google-app">
                                    <img src="assets/frontend/images/google-play.jpg" alt="google play">
                                    <img src="assets/frontend/images/app-store.jpg" alt="app store">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="quotation" class="align-center pb-5 mb-5">
        <div class="inner-content">
            <h2 class="section-title divider">Quote of the day</h2>
            <blockquote data-aos="fade-up">
                <q>“The more that you read, the more things you will know. The more that you learn, the more places
                    you’ll go.”</q>
                <div class="author-name">Dr. Seuss</div>
            </blockquote>
        </div>
    </section>

    <section id="subscribe">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-md-8">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="title-element">
                                <h2 class="section-title divider">Subscribe to our newsletter</h2>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="subscribe-content" data-aos="fade-up">
                                <p>Sed eu feugiat amet, libero ipsum enim pharetra hac dolor sit amet, consectetur. Elit
                                    adipiscing enim pharetra hac.</p>
                                <form id="form">
                                    <input type="text" name="email" placeholder="Enter your email addresss here">
                                    <button class="btn-subscribe">
                                        <span>send</span>
                                        <i class="icon icon-send"></i>
                                    </button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
