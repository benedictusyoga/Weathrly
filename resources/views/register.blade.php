<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <h1 class="text-center mt-5">Register</h1>   
    
    <div class="row justify-content-center mt-5">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                <form action="{{ route('register.submit') }}" method="post">
                    @csrf
                    <label for="">Nama</label>
                    <input type="text" name="name" class="form-control mb-2">
                    <label for="">Usia</label>
                    <input type="text" name="age" class="form-control mb-2">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control mb-2">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control mb-2">
                    <div class="text-center">
                        <button class="btn btn-success mt-4">Register</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>