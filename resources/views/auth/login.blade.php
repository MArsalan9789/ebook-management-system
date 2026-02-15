<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">
</head>
<body>

<div class="container">
    <div class="form-wrapper">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{route('loginuser')}}">
            @csrf
            <h2>Login</h2>

            <div class="input-group">
                <i class='bx bxs-user'></i>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <i class='bx bxs-lock-alt'></i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit">Login</button>

            <p>
                Don't have an account?
                <a href="{{route('registerpage')}}">Register here</a>
            </p>
        </form>
    </div>
</div>
<script src="assets/js/style.js"></script>
</body>
</html>
