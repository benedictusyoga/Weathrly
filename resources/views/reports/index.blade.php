@extends('layout.app')

@section('content')

@include('layout.navbar')
<link href="{{ asset('css/reportIndexStyle.css') }}" rel="stylesheet">

<div class="container">
    <div class="row">
        @forelse($reports as $report)
        <div class="col-md-6 mb-4">
            <div class="card">
                <img src="{{ $report->image_path ? asset('storage/'.$report->image_path) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $report->title }}</h5>
                    <p class="card-text">{{ Str::limit($report->description, 100) }}</p>
                    <p><strong>Location:</strong> {{ $report->location_name }}</p>
                    <a href="{{ route('reports.show', $report) }}" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Tidak ada laporan ditemukan.</p>
        @endforelse
    </div>
</div>

<a href="{{ route('reports.create') }}" class="floating-btn">
    <span>+</span>
</a>

@endsection
