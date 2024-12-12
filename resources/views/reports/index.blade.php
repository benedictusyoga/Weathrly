@extends('layout.app')

@section('content')

<!-- <link href="{{ asset('css/reportIndexStyle.css') }}" rel="stylesheet"> -->


@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" style="position:absolute; z-index:500; top:200px;">{!! session('success') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="overlay" style=" position: fixed; bottom: 0; left: 0; width: 100%; height: 150px; background: linear-gradient(to top, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0)); z-index: -5;"></div>
<!-- Top Controls -->
<div class="content-container">
    <div style="width:50vw; min-width:250px;">
        <h2 class="display-5 mb-4 pt-1 text-white fw-bold">USER ENVIRONMENT REPORTS</h2>
        <form action="{{ route('reports.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search Reports" value="{{ request('search') }}">
            <button type="submit" class="btn btn-success">Search</button>
        </form>
    </div>
    <!-- Scrollable Feed -->
    <div class="feed-container justify-content-center align-items-center bg-opacity-50 p-4 rounded-3 shadow-lg">
        <div class="add-btn mb-3">
            <a href="{{ route('reports.create') }}" class="btn btn-success rounded-circle p-0 shadow-lg" style="width: 60px; height: 60px;">
                <span style=" font-size: 50px; position: absolute; top:-12px;">+</span>
            </a>
            <!-- <p class="text-white bg-success bg-opacity-25 p-0 px-3 rounded mt-2 fw-bold">Add Report</p> -->
        </div>
        @forelse($reports as $report)
        <div class="card shadow-sm mb-3 px-2 py-3">
            <img src="{{ $report->image_path ? Storage::disk('s3')->url($report->image_path) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Image">
            <div class="card-body" style="width:100%;">
                <h5 class="card-title text-truncate h1 fw-bold">{{Str::limit($report->title, 13) }}</h5>
                <p class="card-text fw-normal small"><Strong>Description:</Strong> {{ Str::limit($report->description, 150) }}</p>
                <hr>
                <p class="text-muted small fst-italic"><strong>Location:</strong> {{ $report->location_name }}</p>

            </div>
            <div class="container card-footer">
                <div class="d-flex justify-content-between flex-row align-items-end p-0">
                    <div class="d-flex flex-column">
                        <h5 class="h5 small mb-1"><strong>Updated:</strong></h5>
                        <h5 class="h5 small mb-0"><i>{{ $report->updated_at->format('D, j M y') }}</i></h5>
                    </div>

                    <a href="{{ route('reports.show', $report) }}" class="btn btn-primary btn-sm fw-bold py-1 px-4 rounded-pill">See Detail > </a>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-warning text-center alert-dismissible fade show" style="position:absolute;">
            Tidak ada laporan ditemukan.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforelse
        <!-- Pagination -->
        <div class="d-flex flex-column justify-content-center align-items-center mt-4">
            <!-- Showing X out of X results -->

            <!-- Pagination buttons -->
            <div>
                {{ $reports->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
            <p class="text-dark mb-2">
                Showing <strong>{{ $reports->firstItem() }}</strong> to <strong>{{ $reports->lastItem() }}</strong> of <strong>{{ $reports->total() }}</strong> results
            </p>
        </div>

    </div>
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
        max-width: 600px;
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