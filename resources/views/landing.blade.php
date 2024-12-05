<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>

<body>
    <div class="overlay"></div>
    @include('layout.navbar')
    <div class="content">
        <div class="main-box">
            <h1 class="display-1">Welcome to Weathrly</h1>
            <p>Your trusted source for weather updates.</p>
            @guest
            <div class="container">
                <a href="/login" class="btn btn-primary" role="button">Login</a>
                <a href="/register" class="btn btn-secondary" role="button">Register</a>
            </div>
            @endguest
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>