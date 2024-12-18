@extends('layout.app')

@section('content')
<div class="container d-flex mx-0 pt-5 mt-5 justify-content-center align-items-start bg-opacity-10 shadow-lg" style="max-width:700px; height:80vh; overflow-y:auto;">
    <div class="card shadow-lg border-0 rounded-5 mb-5" style="width:600px; min-width:200px;">
        <div class="card-header bg-warning rounded-top-5 p-4">
            <h4 class="mb-0 h5">Editing Report:</h>
            <h2 class="mb-0 fw-bold"> {{ $report->title }}</h2>
        </div>
    
        <form action="{{ route('reports.update', $report) }}" method="POST" enctype="multipart/form-data" class="card-body">
            @csrf
            @method('PUT')
    
            <div class="mb-3">
                <label for="title" class="form-label">Update Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $report->title }}" required>
            </div>
    
            <div class="mb-3">
                <label for="description" class="form-label">Update Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $report->description }}</textarea>
            </div>
    
            <!-- Lokasi yang dapat dipilih di peta -->
            <div class="mb-3" style="display: none;">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $report->location) }}" required readonly>
            </div>
    
            <!-- Menampilkan Peta untuk Memilih Lokasi -->
            <div class="mb-3">
                <label for="location" class="form-label">Update Location:</label>
                <div id="map" style="height: 400px;" class="form-control"></div>
            </div>
    
            <div class="mb-3 mt-4">
                <label for="image" class="form-label">Upload Photo (Optional)</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
    
            <div class="card-footer d-flex justify-content-between align-items-center p-4">
                <a href="{{ route('reports.show', $report) }}" class="btn btn-warning neg-hover">Cancel</a>
                <button type="submit" class="btn btn-primary pos-hover"><strong>Update</strong> <i class="fa-solid fa-check"></i></button>
            </div>
        </form>
        
    
    </div>
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
