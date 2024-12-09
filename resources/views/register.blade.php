<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/regisStyle.css') }}" rel="stylesheet">
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


    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>