<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="{{ asset('css/landing.css') }}" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body style="margin: 0; padding: 0; font-family: 'Inter';background: url('https://weathrly.s3.ap-southeast-2.amazonaws.com/fabio-jock-pvh68_D9qqI-unsplash.jpg') no-repeat center center fixed;background-size: cover;">
    <div class="overlay" style=" position: fixed; bottom: 0; left: 0; width: 100%; height: 150px; background: linear-gradient(to top, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0)); z-index: 5;"></div>
    @include('layout.navbar')
    <div class="content" style="position: relative; z-index: 10; margin: 0 auto; margin-top: -5%;">
        <div class="main-box @guest guest-mode @endguest" style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 60vh; color: white; text-align: center;">
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

        <div class="weather-det" style=" margin-top: -10%; padding: 20px;">
            @auth
            <!-- Weather Form Section -->
            <form action="{{ route('landing') }}" method="GET" class="mt-3">
                <div class="container-fluid d-flex justify-content-center">
                    <div class="form-container" style="align-self: center; align-items: center; align-content: center; width: 60%; margin-left: 6%;">
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
                <h3 class="text-center fw-bold" style="color: white;">Weather Forecast for {{ $city }}</h3>
                <div class="list-group" style=" background: white; border-radius: 10px; padding: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); max-width: 40%; margin: 0 auto;">
                    @foreach($rainData as $rain)
                    <div class="list-group-item" style=" background-color: rgba(255, 255, 255, 0.9); border: 0; color: #333; font-size: 0.9rem; padding: 8px 10px; margin: auto;">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>