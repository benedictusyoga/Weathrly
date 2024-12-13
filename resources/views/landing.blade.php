<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weathrly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="{{ asset('css/landing.css') }}" rel="stylesheet"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</head>

<body style="margin: 0; padding: 0; font-family: 'Inter';background: url('https://weathrly.s3.ap-southeast-2.amazonaws.com/fabio-jock-pvh68_D9qqI-unsplash.jpg') no-repeat center center fixed;background-size: cover;">
    <div class="overlay" style=" position: fixed; bottom: 0; left: 0; width: 100%; height: 150px; background: linear-gradient(to top, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0)); z-index: 5;"></div>
    @include('layout.navbar')
    <div class="content" style="position: relative; z-index: 10; margin: 0 auto; margin-top: -2%;">
        @guest
        <div class="main-box @guest guest-mode @endguest" style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 65vh; color: white; text-align: center; margin-top:22vh">
            <h1 class="display-1 fw-bold">Welcome to WEATHRLY</h1>
            <p>Your trusted source for weather updates.</p>
            <div class="container">
                <a href="/login" class="btn btn-primary rounded-pill px-4 shadow item-hover" role="button">Login</a>
                <a href="/register" class="btn btn-dark rounded-pill px-4 shadow item-hover" role="button">Register</a>
            </div>
        </div>
        @endguest
        @auth
        <div class="main-box @guest guest-mode @endguest mx-3" style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 30vh; color: white; text-align: center; margin-top:175px;">
            <h1 class="fs-1 fw-bold p-0" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">Welcome,</h1>
            <span class="display-2 fw-semibold fst-italic p-0" style="text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">{{ Str::limit(Auth::user()->name, 20) }}</span>
            <!-- <p>Your trusted source for weather updates.</p> -->
        </div>
        @endauth

        <div class="weather-det" style="padding: 20px;">
            @auth
            <!-- Weather Form Section -->
            <form action="{{ route('landing') }}" method="GET" class="mt-0" style="display:flex; flex-direction: row; justify-content:center;">
                <div class="container d-flex justify-content-center mx-5 align-items-end w-100 gap-1" style="max-width:1600px;">


                    <div class="col-md-6" style="min-width:150px;">
                        <label for="city" class="form-label fw-bold mb-0" style="color:white; font-size:2vh; text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">Choose City</label>
                        <select id="city" name="city" class="form-select" style="font-size:13px; width:100%;">
                            @foreach($locations as $name => $coords)
                            <option value="{{ $name }}" {{ $city == $name ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-center align-items-end">
                        <button class="btn btn-success shadow" type="submit" style="width:100%; max-width:100px; text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);"><i class="fa-solid fa-magnifying-glass-arrow-right"></i></button>
                    </div>
                </div>
            </form>


            <!-- Weather Results Section -->
            <div class="container mt-3 justify-content-center">
                @if(!empty($rainData))
                <h3 class="text-center fw-bold" style="color: white; text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">Weather Forecast for <span class="badge text-bg-success shadow">{{ $city }}</span></h3>
                <div class="list-group" style=" background: white; border-radius: 10px; padding: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); min-width:200px; max-width: 700px; margin: 0 auto;">
                    @foreach($rainData as $rain)
                    <div class="list-group-item" style=" background-color: rgba(255, 255, 255, 0.9); border: 0; color: #333; font-size: 0.8rem; padding: 8px 10px; margin: auto;">
                        @if(number_format($rain['rain_mm'], 2) < 0.1)
                            <strong>{{ $rain['time'] }}</strong> - Sunny <img src="https://weathrly.s3.ap-southeast-2.amazonaws.com/weather_styles/sun.png" alt="Sunny" width="40px" height="40px"> ({{ number_format($rain['rain_mm'], 2) }} mm)
                            @elseif(number_format($rain['rain_mm'], 2) > 0.1 && number_format($rain['rain_mm'], 2) < 0.5)
                                <strong>{{ $rain['time'] }}</strong> - Cloudy <img src="https://weathrly.s3.ap-southeast-2.amazonaws.com/weather_styles/cloudy.png" alt="Cloudy" width="40px" height="40px"> ({{ number_format($rain['rain_mm'], 2) }} mm)
                                @else
                                <strong>{{ $rain['time'] }}</strong> - Storm <img src="https://weathrly.s3.ap-southeast-2.amazonaws.com/weather_styles/storm.png" alt="Storm" width="40px" height="40px"> ({{ number_format($rain['rain_mm'], 2) }} mm)
                                @endif
                    </div>
                    <div class="text-dark w-100 d-flex justify-content-center m-0 p-0" style="height:min-content;">
                        <hr class="m-0 p-0" style="width:50%; height:min-content;">
                    </div>

                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
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

    <style>
        .form-select:focus {
            /* box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; */
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            border: none;
        }
        .item-hover {
            transition: transform 0.2s ease;
        }

        .item-hover:hover {
            transform: translateY(-10%);
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>