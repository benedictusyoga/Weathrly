@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Laporan: {{ $report->title }}</h2>

    <div class="card mb-3">
        <img src="{{ $report->image_path ? Storage::disk('s3')->url($report->image_path) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Image">

        <div class="card-body">
            <h5 class="card-title">{{ $report->title }}</h5>
            <p class="card-text">{{ $report->description }}</p>
            <p><strong>Lokasi:</strong> {{ $report->location_name}}</p>
        </div>
    </div>

    <!-- Menampilkan lokasi pada peta -->
    <div id="map" style="height: 400px;"></div>

    <!-- Button Edit dan Delete -->
    <a href="{{ route('reports.edit', $report) }}" class="btn btn-warning mt-3">Edit Laporan</a>

    <form action="{{ route('reports.destroy', $report) }}" method="POST" class="d-inline mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus Laporan</button>
    </form>

    <a href="{{ route('reports.index') }}" class="btn btn-link mt-3">Kembali ke Daftar Laporan</a>
</div>

<script>
    var map = L.map('map').setView([{{ explode(',', $report->location)[0] }}, {{ explode(',', $report->location)[1] }}], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker([{{ explode(',', $report->location)[0] }}, {{ explode(',', $report->location)[1] }}]).addTo(map);
</script>
@endsection
