@extends('layouts.admin')

@section('content')
    <div class="container mt-3">

        <!-- Users Growth Chart -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="fw-semibold mb-0">Users Growth</h6>
                                <small class="text-muted">Last 6 Months</small>
                            </div>
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                +12.4%
                            </span>
                        </div>
                        <canvas id="usersChart" height="90"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <!-- ROW 1: Users Stats -->
        <div class="row g-4 mt-2">

            <!-- Total Users -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('alluser') }}" class="card-link">
                    <div class="stat-card green shadow">
                        <i class="fa fa-users fa-2x"></i>
                        <h3>{{ $totalUsers }}</h3>
                        <p>Total Users</p>
                    </div>
                </a>
            </div>

            <!-- Admins -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('alluser') }}?role=admin" class="card-link">
                    <div class="stat-card blue shadow">
                        <i class="fa fa-user-shield fa-2x"></i>
                        <h3>{{ $totalAdmins }}</h3>
                        <p>Admins</p>
                    </div>
                </a>
            </div>

            <!-- Normal Users -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('alluser') }}?role=user" class="card-link">
                    <div class="stat-card orange shadow">
                        <i class="fa fa-user fa-2x"></i>
                        <h3>{{ $totalNormalUsers }}</h3>
                        <p>Normal Users</p>
                    </div>
                </a>
            </div>

        </div>

        <!-- ROW 2: Books, Orders, Revenue, Competitions -->
        <div class="row g-4 mt-3">

            <!-- Total Books -->
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('booklist') }}" class="card-link">
                    <div class="stat-card blue shadow">
                        <i class="fa fa-book fa-2x"></i>
                        <h3>{{ \App\Models\Book::count() }}</h3>
                        <p>Total Books</p>
                    </div>
                </a>
            </div>

            <!-- Total Orders -->
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('orderlist') }}" class="card-link">
                    <div class="stat-card green shadow">
                        <i class="fa fa-shopping-cart fa-2x"></i>
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Orders</p>
                    </div>
                </a>
            </div>

            <!-- Total Revenue -->
            <div class="col-lg-3 col-md-6">
                <div class="stat-card red shadow">
                    <i class="fa fa-money-bill fa-2x"></i>
                    <h3>Rs {{ number_format($totalRevenue) }}</h3>
                    <p>Total Revenue</p>
                </div>
            </div>

            <!-- Competitions -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('competitionlist') }}" class="card-link" style="text-decoration:none;">
                    <div class="stat-card red">
                        <i class="fa fa-trophy"></i>
                        <h3>{{ $totalCompetitions }}</h3>
                        <p>Competitions</p>
                    </div>
                </a>
            </div>

        </div>

    </div>

    <!-- Script for Chart.js -->
    <script>
        // const usersPerMonth = @json(array_values($usersPerMonth->toArray()));
        // const ordersData = @json(array_values($ordersPerMonth->toArray()));
        window.usersPerMonth = @json(array_values($usersPerMonth->toArray()));
        window.ordersData = @json(array_values($ordersPerMonth->toArray()));
    </script>
@endsection
