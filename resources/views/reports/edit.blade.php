@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Laporan: {{ $report->title }}</h2>

    <form action="{{ route('reports.update', $report) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $report->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $report->description }}</textarea>
        </div>

        <!-- Lokasi yang dapat dipilih di peta -->
        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $report->location) }}" required readonly>
        </div>

        <!-- Menampilkan Peta untuk Memilih Lokasi -->
        <div id="map" style="height: 400px;"></div>

        <div class="mb-3">
            <label for="image" class="form-label">Unggah Foto (Opsional)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Laporan</button>
    </form>

    <a href="{{ route('reports.show', $report) }}" class="btn btn-link mt-3">Kembali ke Detail Laporan</a>
</div>

<script>
    // Inisialisasi peta
    var map = L.map('map').setView([{{ explode(',', $report->location)[0] }}, {{ explode(',', $report->location)[1] }}], 13); // Lokasi awal berdasarkan koordinat laporan

    // Menambahkan TileLayer dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Marker untuk lokasi yang sudah ada
    var marker = L.marker([{{ explode(',', $report->location)[0] }}, {{ explode(',', $report->location)[1] }}]).addTo(map);

    // Update input lokasi berdasarkan koordinat yang dipilih
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Pindahkan marker
        marker.setLatLng([lat, lng]);

        // Isi input lokasi dengan koordinat
        document.getElementById('location').value = lat + ', ' + lng;
    });
</script>
@endsection
