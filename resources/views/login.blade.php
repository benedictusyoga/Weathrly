<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        body {
            background: url('https://weathrly.s3.ap-southeast-2.amazonaws.com/fabio-jock-pvh68_D9qqI-unsplash.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
            color: #333;
        }

        h1 {
            font-size: 2.5rem;
            text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);
            color: #333;
        }

        .card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
        }

        .form-label {
            color: #333;
        }

        .btn-success {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-success:hover {
            background-color: #0056b3;
            border-color: #0056b3;
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
    <div class="d-flex justify-content-center align-items-center vh-100 flex-column mx-5">
        <h1 class="fw-bold mb-4 text-center text-white">Login to WEATHRLY</h1>
        <div class="card p-4" style="min-width:300px; max-width: 40vw;">
            <div class="card-body">
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="username" class="form-label mb-0">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter username..." value="{{ old('username') }}">
                        @error('username')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label mb-0">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password...">
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                Show
                            </button>
                        </div>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success w-100 mt-4">Login</button>
                </form>
                <p class="mt-3 text-center">Don’t have a WEATHRLY account? <a href="{{ route('register') }}" class="btn-link fw-bold">REGISTER</a></p>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const isPassword = passwordField.type === 'password';

            passwordField.type = isPassword ? 'text' : 'password';
            this.textContent = isPassword ? 'Hide' : 'Show';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
