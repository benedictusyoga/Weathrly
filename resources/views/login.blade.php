<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loginStyle.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
<div class="d-flex justify-content vh-100">
    <div class="text-center position-absolute top-50 translate-middle-y w-100 ">
        <h1 class="text-white fw-bold mb-4 display-4">Login to WEATHRLY</h1>
        <div class="mx-auto" style="max-width: 300px;">
            <form action="{{ route('login.post') }}" method="POST" class="p-4">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label fw-bold text-white">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Insert your username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold text-white">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Input your password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="text-white mt-3">Don’t have a WEATHRLY account? <a href="{{ route('register') }}" class="text-info fw-bold">REGISTER</a></p>
        </div>
    </div>
</div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
