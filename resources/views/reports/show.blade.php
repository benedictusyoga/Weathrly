@extends('layout.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-3 mb-4">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Detail Laporan: {{ $report->title }}</h2>
        </div>

        <img src="{{ $report->image_path ? Storage::disk('s3')->url($report->image_path) : 'https://via.placeholder.com/150' }}" class="card-img-top rounded-3" alt="Image">

        <div class="card-body">
            <h5 class="card-title">{{ $report->title }}</h5>
            <p class="card-text">{{ $report->description }}</p>
            <p><strong>Lokasi:</strong> {{ $report->location_name }}</p>
        </div>

        <!-- Menampilkan lokasi pada peta -->
        <div id="map" class="mb-4 rounded-3" style="height: 400px;"></div>

        <div class="card-footer d-flex justify-content-between mt-3">
            <a href="{{ route('reports.edit', $report) }}" class="btn btn-warning rounded-pill">
                <i class="bi bi-pencil-square"></i> Edit Laporan
            </a>

            <form action="{{ route('reports.destroy', $report) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger rounded-pill">
                    <i class="bi bi-trash"></i> Hapus Laporan
                </button>
            </form>
        </div>

        <div class="card-footer text-center mt-3">
            <a href="{{ route('reports.index') }}" class="btn btn-link">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Daftar Laporan
            </a>
        </div>
    </div>
</div>

<script>
    var map = L.map('map').setView([{{ explode(',', $report->location)[0] }}, {{ explode(',', $report->location)[1] }}], 10);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    L.marker([{{ explode(',', $report->location)[0] }}, {{ explode(',', $report->location)[1] }}]).addTo(map);
</script>
@endsection
