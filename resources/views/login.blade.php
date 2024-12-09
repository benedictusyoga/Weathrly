<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loginStyle.css') }}" rel="stylesheet">
</head>

<body>
<div class="d-flex justify-content vh-100">
    <div class="text-center position-absolute top-50 translate-middle-y w-100 ">
        <h1 class="text-white fw-bold mb-4 display-4">Login to WEATHRLY</h1>
        <div class="mx-auto" style="max-width: 300px;">
            <form action="{{ route('login.post') }}" method="POST" class="p-4">
            @csrf
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control mb-2" placeholder="Enter username..." value="{{ old('username') }}">

                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control mb-2" placeholder="Enter password..." value="{{ old('password') }}">

                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-100" name="submit">Login</button>
                        </div>
            </form>
            @if ($errors->any())
                    <div class="alert alert-danger">

                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        @endforeach

                    </div>
                    @endif
            <p class="text-white mt-3">Don’t have a WEATHRLY account? <a href="{{ route('register') }}" class="text-info fw-bold">REGISTER</a></p>
        </div>
    </div>
</div>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>