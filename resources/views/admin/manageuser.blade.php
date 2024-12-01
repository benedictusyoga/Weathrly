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
        <h1>Kelola User</h1>
        <table class="table">
            <thead class="fs-2">
               <th scope="col">ID</th> 
               <th scope="col">Name</th>
               <th scope="col">Age</th>
               <th scope="col">Username</th>
               <th scope="col"></th>
            </thead>
            <tbody class="fs-4">
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        <form action="{{ route('delete', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a class="btn btn-primary" href="{{ route('dashboard') }}">Back To dashboard</a>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>