<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Cuaca</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

<h1 class="text-center mt-5">Cuaca Indonesia</h1>

<form action="{{ route('heat') }}" method="GET">
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
    @if(isset($isHot) && $isHot)
        <div class="alert alert-danger">
            <h3>Cuaca Panas di {{ $city }}</h3>
            <p><strong>Suhu:</strong> {{ number_format($temperature, 2) }}°C</p>
            <p><strong>Waktu:</strong> {{ $time }}</p>
            <p><strong>Pesan:</strong> {{ $message }}</p>
        </div>
    @elseif(isset($isHot) && !$isHot)
        <div class="alert alert-success">
            <h3>Cuaca di {{ $city }}</h3>
            <p><strong>Suhu:</strong> {{ number_format($temperature, 2) }}°C</p>
            <p><strong>Waktu:</strong> {{ $time ?? 'Tidak tersedia' }}</p>
            <p><strong>Pesan:</strong> {{ $message }}</p>
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