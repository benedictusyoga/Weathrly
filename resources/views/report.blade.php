@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Laporkan Kondisi Lingkungan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="map" class="form-label">Pilih Lokasi</label>
            <div id="map" style="height: 300px;"></div>
            <input type="hidden" id="location" name="location">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Unggah Foto (Opsional)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Kirim Laporan</button>
    </form>

    <!-- Link kembali ke daftar laporan -->
    <a href="{{ route('reports.index') }}" class="btn btn-link mt-3">Lihat Semua Laporan</a>
</div>

<script>
    // Inisialisasi Peta
    var map = L.map('map').setView([-2.5489, 118.0149], 5); // Indonesia Center
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var marker;
    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
        document.getElementById('location').value = e.latlng.lat + ',' + e.latlng.lng;
    });
</script>
@endsection
