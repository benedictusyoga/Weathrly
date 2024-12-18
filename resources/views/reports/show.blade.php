@extends('layout.app')

@section('content')
<div class="container d-flex mx-0 pt-5 mt-5 justify-content-center align-items-start bg-opacity-10 shadow-lg" style="max-width:700px; height:80vh; overflow-y:auto;">
    <div class="card shadow-lg border-0 rounded-5 mb-5" style="width:600px; min-width:200px;">
        <div class="card-header bg-primary text-white rounded-top-5 p-4">
            <h3 class="mb-0 h5">Now Viewing: </h3>
            <h2 class="mb-0 fw-bold">{{ $report->title }}</h2>
        </div>

        <img src="{{ $report->image_path ? Storage::disk('s3')->url($report->image_path) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Image" style="height:200px; object-fit:cover;">

        <div class="card-body">
            <p class="card-text small card-text fw-normal">{{ $report->description }}</p>
            <hr>
            <p class="text-muted small fst-italic"><strong>Lokasi:</strong> {{ $report->location_name }}</p>
        </div>

        <!-- Menampilkan lokasi pada peta -->
        <div class="d-flex justify-content-center align-items-center" style="width: 100%;">
             <div id="map" class="mb-4 rounded-5" style="height: 200px; width:90%;"></div>
        </div>

        <div class="card-footer d-flex justify-content-around mt-3 py-4 align-items-center">
            <form action="{{ route('reports.destroy', $report) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg rounded neg-hover">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
            <a href="{{ route('reports.edit', $report) }}" class="btn btn-warning rounded-pill pos-hover shadow-lg fw-semibold px-3">
                <i class="fa-solid fa-pen"></i> Edit
            </a>

        </div>

        <div class="card-footer text-center">
            <a href="{{ route('reports.index') }}" class="btn btn-link">
                <i class="bi bi-arrow-left-circle">
                    < Back to Reports</i>
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