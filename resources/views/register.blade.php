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
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center position-absolute top-50 translate-middle-y w-100">
            <h1 class="text-white fw-bold mb-4 display-4">Register to WEATHRLY</h1>
            <div class="mx-auto" style="max-width: 300px;">
                <form action="{{ route('register.post') }}" method="POST" class="p-4">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="text" id="age" name="age" class="form-control" placeholder="Enter your age">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter a username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter a password">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Register</button>
                </form>
                <p class="text-white mt-3">Already have a WEATHRLY account? <a href="{{ route('login') }}" class="text-info fw-bold">REGISTER</a></p>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>