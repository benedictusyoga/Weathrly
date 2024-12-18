@extends('layout.app')

@section('content')

<!-- <link href="{{ asset('css/reportIndexStyle.css') }}" rel="stylesheet"> -->


@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" style="position:absolute; z-index:500; top:200px;">{!! session('success') !!}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<!-- Top Controls -->
<div class="content-container">
    <h2 class="display-5 mt-2 pt-1 mb-0 text-white fw-bold mx-4" style="text-align:center; text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);">ENVIRONMENT REPORTS</h2>
    <div style="width:50vw; min-width:250px;">
        <form action="{{ route('reports.index') }}" method="GET" class="d-flex align-items-center">
            <input type="text" name="search" class="form-control me-2 py-3" placeholder="Search Reports" value="{{ request('search') }}" style="max-height:3vh; font-size:14px;">
            <button type="submit" class="btn btn-success btn-lg item-hover"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <!-- Scrollable Feed -->
    <div class="feed-container justify-content-center align-items-center bg-opacity-50 p-4 rounded-3 shadow-lg">
        <div class="add-btn mb-3 item-hover">
            <div class="alert alert-warning alert-dismissible fade show" style="position:absolute; z-index:500; width:max-content; right:10px; bottom:6vh;"><strong>Add a New Report Here!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <a href="{{ route('reports.create') }}" class="btn btn-success rounded-circle p-0 shadow" style="width: 60px; height: 60px;">
                <i class="fas fa-plus" style="font-size: 2rem;"></i>
            </a>
        </div>
        @forelse($reports as $report)
        <div class="card shadow-sm mb-3 px-2 py-3 shadow">
            <img src="{{ $report->image_path ? Storage::disk('s3')->url($report->image_path) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Image">
            <div class="card-body" style="width:100%;">
                <h5 class="card-title text-truncate h1 fw-bold">{{Str::limit($report->title, 13) }}</h5>
                <p class="card-text fw-normal small"><Strong>Description:</Strong> {{ Str::limit($report->description, 150) }}</p>
                <hr>
                <p class="text-muted small fst-italic"><strong>Location:</strong> {{ Str::limit($report->location_name, 40) }}</p>

            </div>
            <div class="container card-footer">
                <div class="d-flex justify-content-between flex-row align-items-end p-0">
                    <div class="d-flex flex-column">
                        <h5 class="h5 small mb-1"><strong>Updated:</strong></h5>
                        <h5 class="h5 small mb-0"><i>{{ $report->updated_at->format('D, j M y') }}</i></h5>
                    </div>

                    <a href="{{ route('reports.show', $report) }}" class="btn btn-primary btn-sm fw-bold py-1 px-4 rounded-pill shadow item-hover">See Detail > </a>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center d-flex justify-content-center flex-column" style="">
            <div class="bg-warning px-4 py-2 rounded-pill fw-semibold mb-2">No Reports Yet :(</div>
            <p>Please add a report with the button Below</p>
            <div class="mb-3">
                <a href="{{ route('reports.create') }}" class="btn btn-success rounded-pill p-0 shadow-lg" style="width: 100px; height: 40px;">
                    <span style=" font-size: 30px; position:relative; top:-15%;">+</span>
                </a>
                <!-- <p class="text-white bg-success bg-opacity-25 p-0 px-3 rounded mt-2 fw-bold">Add Report</p> -->
            </div>
        </div>
        @endforelse
        <!-- Pagination -->

    </div>
    <div class="d-flex flex-column justify-content-end align-items-center" style="position:absolute; bottom:0px; left:0px; width:100vw; max-height:10vh;">
        <!-- Showing X out of X results -->

        <!-- Pagination buttons -->
        <div class="mb-0 d-flex align-items-start" style="position:relative; margin-top:85px;">
            <div class="custom-pagination">
                {{ $reports->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <p class="px-4 py-2 bg-white text-dark rounded-pill" style="font-size:13px;position:relative; top:-15px;">
            Showing <strong>{{ $reports->firstItem() }}</strong> to <strong>{{ $reports->lastItem() }}</strong> of <strong>{{ $reports->total() }}</strong> results
        </p>
    </div>
</div>

<style>
    .custom-pagination .page-link {
        font-size: 12px;
    }

    .add-btn {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: center;
        text-align: center;
        position: fixed;
        bottom: 4vh;
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
        max-height: calc(100vh - 300px);
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