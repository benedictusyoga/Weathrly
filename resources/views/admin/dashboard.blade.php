<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-bold fs-1">Dashboard Admin</h1>
    <p class="fs-3">Selamat datang, Admin</p>
    <div class="text-right">
    <a class="btn btn-primary" href="{{ route('manageuser') }}">View User</a>
    </div>
    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="mt-3 btn btn-dark" type="submit">Logout</button>
    </form>                     
</div>

<script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>