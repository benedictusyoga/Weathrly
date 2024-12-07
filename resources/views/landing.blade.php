<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="overlay"></div>
        @include('layout.navbar')
        <div class="content">
        <div class="main-box @guest guest-mode @endguest">
        @guest
        <h1 class="display-1 fw-bold">Welcome to WEATHRLY</h1>
        <p>Your trusted source for weather updates.</p>
        <div class="container">
            <a href="/login" class="btn btn-primary" role="button">Login</a>
            <a href="/register" class="btn btn-secondary" role="button">Register</a>
        </div>
        @endguest

        @auth
        <h1 class="display-1 fw-bold">Welcome, <span>{{ Auth::user()->name }}</span></h1>
        <p>Your trusted source for weather updates.</p>
        @endauth
    </div>

        <div class="weather-det">
        @auth
        <!-- Weather Form Section -->
        <form action="{{ route('landing') }}" method="GET" class="mt-3">
        <div class="container-fluid d-flex justify-content-center">
    <div class="form-container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-2 text-end">
                <label for="city" class="form-label fw-bold">Choose City</label>
            </div>
            <div class="col-md-6">
                <input type="text" id="city" name="city" class="form-control" placeholder="Enter city" value="{{ $city }}">
            </div>
            <div class="col-md-1">
                <button class="btn btn-success w-100" type="submit">Show</button>
            </div>
        </div>
    </div>
</div>

        </form>


        <!-- Weather Results Section -->
        <div class="container mt-3">
            @if(!empty($rainData))
            <h3 class="text-center fw-bold">Weather Forecast for {{ $city }}</h3>
            <div class="list-group">
                @foreach($rainData as $rain)
                <div class="list-group-item">
                    <strong>{{ $rain['time'] }}</strong> - Hujan ({{ number_format($rain['rain_mm'], 2) }} mm)
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $rainData->links('pagination::bootstrap-4') }}
            </div>
            @elseif(isset($message))
            <div class="alert alert-info">
                <p>{{ $message }}</p>
            </div>
            @else
            <div class="alert alert-warning">
                <p>No weather data available for this city.</p>
            </div>
            @endif
        </div>
        @endauth
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
