<!DOCTYPE html>
<html lang="en">

<head>
    <title>BookSaw - </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" type="image/png" href="{{ asset('assets/frontend/images/main-logo.png') }}">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/icomoon/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/logout.css') }}">
</head>

<body data-bs-spy="scroll" data-bs-target="#header">

    <div id="header-wrap">

        {{-- ================= TOP BAR ================= --}}
        <div class="top-content">
            <div class="container-fluid">
                <div class="row align-items-center">

                    <div class="col-md-6">
                        <div class="social-links">
                            <ul>
                                <li><a href="#"><i class="icon icon-facebook"></i></a></li>
                                <li><a href="#"><i class="icon icon-twitter"></i></a></li>
                                <li><a href="#"><i class="icon icon-youtube-play"></i></a></li>
                                <li><a href="#"><i class="icon icon-behance-square"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="right-element d-flex justify-content-end align-items-center gap-3">

                            @auth
                                <span class="user-account for-buy">
                                    <i class="icon icon-user"></i>
                                    {{ Auth::user()->name }}
                                </span>

                                <form action="{{ route('logout') }}" method="POST" class="d-inline m-0 p-0">
                                    @csrf
                                    <button type="submit" class="logout-small">
                                        <i class="icon icon-power">Logout</i>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('loginpage') }}" class="user-account for-buy">
                                    <i class="icon icon-user"></i> Login
                                </a>
                                <a href="{{ route('registerpage') }}" class="user-account for-buy">
                                    Register
                                </a>
                            @endauth

                            <a href="{{ route('cart') }}" class=" btn-primary position-relative">
                                Cart<i class="icon icon-clipboard"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ session('cart') ? count(session('cart')) : 0 }}
                                </span>
                            </a>

                            {{-- Search --}}
                            <div class="action-menu">
                                <div class="search-bar">
                                    <a href="#" class="search-button search-toggle" data-selector="#header-wrap">
                                        <i class="icon icon-search"></i>
                                    </a>
                                    <form action="{{ route('search') }}" method="GET" class="d-flex mx-3">
                                        <input class="form-control me-2" type="search" name="q"
                                            placeholder="Search books..." aria-label="Search">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{-- ================= END TOP BAR ================= --}}

        {{-- ================= NAVBAR ================= --}}
        <header id="header">
            <div class="container-fluid">
                <div class="row align-items-center">

                    <div class="col-md-2">
                        <div class="main-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/frontend/images/main-logo.png') }}" class="img-fluid"
                                    alt="Logo">
                            </a>
                        </div>
                    </div>

                    <div class="col-md-10">
                        <nav id="navbar">
                            <div class="main-menu stellarnav">
                                <ul class="menu-list">
                                    <li class="menu-item active">
                                        <a href="{{ route('home') }}">Home</a>
                                    </li>


                                    @auth
                                        <li class="menu-item">
                                            <a href="{{ route('userdashboard') }}">My Books</a>
                                        </li>
                                    @endauth

                                    <li class="menu-item">
                                        <a href="{{ route('shop') }}">All Books</a>
                                    </li>

                                    <li class="menu-item">
                                        <a href="{{ route('competitions') }}">Competitions</a>
                                    </li>


                                    <li class="menu-item">
                                        <a href="{{ route('bookshelf') }}">book shelf</a>
                                    </li>


                                </ul>


                                <div class="hamburger">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>
                            </div>
                        </nav>
                    </div>

                </div>
            </div>
        </header>
        {{-- ================= END NAVBAR ================= --}}

    </div>
