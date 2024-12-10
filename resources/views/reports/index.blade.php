@extends('layout.app')

@section('content')

<!-- <link href="{{ asset('css/reportIndexStyle.css') }}" rel="stylesheet"> -->


@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">{{ session('success') }}</div>
@endif
<!-- Top Controls -->
<div class="content-container">
    <div style="width:50vw; min-width:250px;">
        <h2 class="display-5 mb-4 pt-0 text-white">Daftar Laporan Lingkungan</h2>
        <form action="{{ route('reports.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari laporan berdasarkan judul atau lokasi" value="{{ request('search') }}">
            <button type="submit" class="btn btn-success">Cari</button>
        </form>
    </div>
    <!-- Scrollable Feed -->
    <div class="feed-container justify-content-center align-items-center">
        <div class="add-btn">
            <a href="{{ route('reports.create') }}" class="btn btn-primary rounded-circle p-0" style="width: 60px; height: 60px; font-size: 50px;">
                +
            </a>
            <p class="text-white">Add Report</p>
        </div>
        @forelse($reports as $report)
        <div class="card shadow-sm mb-3">
            <img src="{{ $report->image_path ? Storage::disk('s3')->url($report->image_path) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Image">
            <div class="card-body">
                <h5 class="card-title text-truncate">{{ $report->title }}</h5>
                <p class="card-text">{{ Str::limit($report->description, 100) }}</p>
                <p class="text-muted small"><strong>Lokasi:</strong> {{ $report->location_name }}</p>
                <a href="{{ route('reports.show', $report) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
            </div>
        </div>
        @empty
        <div class="alert alert-warning text-center alert-dismissible fade show">
            Tidak ada laporan ditemukan.
        </div>
        @endforelse
    </div>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $reports->links() }}
</div>


<style>
    .add-btn {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        text-align: center;
        position: fixed;
        bottom: 1vh;
        right: 2rem;
        z-index: 999;
    }

    .add-btn span {
        font-size: 0.5vh;
    }

    .add-btn a {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .content-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        gap: 20px;
    }

    .feed-container {
        justify-content: center;
        align-items: center;
        place-self: center;
        max-height: calc(100vh - 250px);
        /* Adjust height as needed */
        overflow-y: auto;
        overflow-x: hidden;
        min-width: 200px;
        /* Prevent content cut-off near scrollbar */
    }

    .card {
        /* position: relative; */
        /* left: 1vw; */
        max-width: 95%;
        align-items: start;
        border: 1px solid #ddd;
        /* Subtle border for card separation */
        border-radius: 8px;
        /* Smooth rounded corners */
        overflow: hidden;
        overflow-x: hidden;
        /* Ensure image corners align with card corners */
    }

    .card-img-top {
        height: 200px;
        /* Set consistent image height */
        object-fit: cover;
        /* Ensure image covers the space without distortion */
    }

    .card-body {
        padding: 15px;
    }

    .mb-3 {
        margin-bottom: 20px !important;
        /* Consistent gap between cards */
    }
</style>

@endsection