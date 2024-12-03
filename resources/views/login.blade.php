<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>

    <div class="row justify-content-center mt-5">
        <h1 class="text-center mt-5 display-1 fw-bolder">Welcome to WEATHRLY</h1>
        <h1 class="text-center mt-4 mb-4">Login</h1>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control mb-2" placeholder="Enter username">

                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control mb-2" placeholder="Enter password">

                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-100">Login</button>
                        </div>

                        <p class="text-center mt-4">Belum punya akun <a href="{{ route('register') }}">Register</a></p>
                    </form>
                    @if(session('gagal'))
                    <p class="text-danger">{{ session('gagal') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>