@extends('layout.app')

@section('content')
<div class="container d-flex mx-0 pt-5 mt-5 justify-content-center align-items-start bg-opacity-10 shadow-lg" style="max-width:700px; height:80vh; overflow-y:auto;">
    <div class="card shadow-lg border-0 rounded-5 mb-5" style="width:600px; min-width:200px;">
        <div class="card-header bg-success rounded-top-5 p-4 text-white">
            <h4 class="mb-0 h5">Submit a New Report:</h4>
        </div>

        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data" class="card-body">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Report Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Select Location:</label>
                <div id="map" style="height: 400px;"></div>
                <input type="hidden" id="location" name="location">
            </div>

            <div class="mb-3 mt-4">
                <label for="image" class="form-label">Upload Photo (Optional)</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center p-4">
                <a href="{{ route('reports.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-success">Submit Report</button>
            </div>
        </form>

    </div>
</div>

<script>
    // Initialize map
    var map = L.map('map').setView([-2.5489, 118.0149], 5); // Centered on Indonesia
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
