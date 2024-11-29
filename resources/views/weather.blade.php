<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Cuaca</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
@include('layout.navbar')
<h1 class="text-center mt-5">Cuaca Indonesia</h1>

<form action="{{ route('report') }}" method="GET">
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
                    <a class="btn btn-danger mt-3" href="{{ route('landing') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
</form>

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



    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>