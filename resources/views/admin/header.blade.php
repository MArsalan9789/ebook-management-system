<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="shortcut icon" href="assets/frontend/images/main-logo.png" type="image/x-icon">
</head>
<body>
<div class="topbar admin-header d-flex justify-content-between align-items-center bg-light p-2">
    <button class="btn btn-primary d-md-none" id="sidebarToggle">
    <i class="fas fa-bars"></i>
</button>


    <h2 class="m-0">Admin Panel</h2>

    <span class="admin-name">
        {{ auth()->user()->name }}
    </span>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('assets/admin/js/admin.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/admin.js') }}"></script>
@yield('scripts')
</body>
</html>


