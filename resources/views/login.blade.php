<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="{{ asset('css/loginStyle.css') }}" rel="stylesheet"> -->
    <style>
        body {
            background: url('https://weathrly.s3.ap-southeast-2.amazonaws.com/fabio-jock-pvh68_D9qqI-unsplash.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
            color: #fff;
        }

        form {
            background-color: transparent;
            box-shadow: none;
            border: none;
        }

        h1 {
            font-size: 2.5rem;
            text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);
        }

        form label {
            display: block;
            text-align: left;
            color: white;
            margin-bottom: 5px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a.text-info:hover {
            color: #0052aa !important;
            text-decoration: none;
        }
    </style>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>