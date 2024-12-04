<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
</head>

<body>
    <div class="overlay"></div>
    @include('layout.navbar')
    <div class="content">
        <div class="main-box">
            @guest
            <h1 class="display-1">Welcome to WEATHRLY</h1>
            @endguest
            @auth
            <h1 class="display-1">Welcome, <span>{{ Auth::user()->name }}</span></h1>
            @endauth
            <p>Your trusted source for weather updates.</p>
            @guest
            <div class="container">
                <a href="/login" class="btn btn-primary" role="button">Login</a>
                <a href="/register" class="btn btn-secondary" role="button">Register</a>
            </div>
            @endguest
        </div>

        <!-- Weather Form Section -->
        <form action="{{ route('landing') }}" method="GET">
            <div class="row justify-content-center mt-5">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <label for="city">Pilih Kota:</label>
                            <select name="city" id="city" class="form-control">
                                <option value="Jakarta" {{ $city == 'Jakarta' ? 'selected' : '' }}>Jakarta</option>
                                <option value="Tangerang" {{ $city == 'Tangerang' ? 'selected' : '' }}>Tangerang</option>
                            </select>
                            <button class="btn btn-success mt-3" type="submit">Tampilkan Cuaca</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Weather Results Section -->
        <div class="container mt-5">
            @if(!empty($rainData))
            <h3>Prediksi Hujan di {{ $city }}</h3>
            <ul class="list-group">
                @foreach($rainData as $rain)
                <li class="list-group-item">
                    <strong>{{ $rain['time'] }}</strong> - Hujan: {{ number_format($rain['rain_mm'], 2) }} mm
                </li>
                @endforeach
            </ul>
            @elseif(isset($message))
            <div class="alert alert-info">
                <p>{{ $message }}</p>
            </div>
            @else
            <div class="alert alert-warning">
                <p>Tidak ada data cuaca untuk kota ini.</p>
            </div>
            @endif
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>

</html>