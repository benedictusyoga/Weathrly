<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://weathrly.s3.ap-southeast-2.amazonaws.com/fabio-jock-pvh68_D9qqI-unsplash.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Inter', sans-serif;
            color: #fff;
        }

        form {
            background: transparent;
            padding: 20px;
            border-radius: 10px;
        }

        form label {
            display: block;
            text-align: left;
            color: white;
            margin-bottom: 5px;
        }

        h1 {
            color: white;
            font-weight: bold
        }

        label {
            display: flex;
            font-weight: bold;
            color: white;
        }

        .card {
            background: transparent;
            border: none;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
        }

        .btn-success {
            font-weight: bold;
            background-color: #007bff;
            border: none;
        }

        .btn-success:hover {
            background-color: #0056b3;
        }

        p {
            color: white;
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a.text-info:hover {
            color: #0052aa !important;
            text-decoration: none;
        }

        .custom-margin {
            margin-top: 100px;
        }
    </style>
</head>

<body>
    <h1 class="text-center custom-margin">Register to WEATHRLY</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('register.post') }}" method="POST">
                        @csrf
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control mb-2" value="{{ old('name') }}" placeholder="Enter your full name...">

                        <label for="age">Usia</label>
                        <input type="number" name="age" class="form-control mb-2" value="{{ old('age') }}" placeholder="Enter your age...">

                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control mb-2" value="{{ old( 'username') }}" placeholder="Enter your desired username...">
                        <p class="text-danger small mt-0 pt-0">(Permanent & <b>CANNOT</b> be changed later)</p>

                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control mb-2" placeholder="Enter your password...">

                        @if($errors->has('username'))
                        <div class="alert alert-danger mt-2">
                            {{ $errors->first('username') }}
                        </div>
                        @endif

                        <div class="text-center">
                            <button class="btn btn-success mt-4">Register</button>
                        </div>
                    </form>
                    <p class="text-white mt-3">Already have a WEATHRLY account? <a href="{{ route('login') }}" class="text-info fw-bold">LOGIN</a></p>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>