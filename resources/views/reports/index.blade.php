@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Laporan Lingkungan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Tombol untuk membuat laporan baru -->
    <a href="{{ route('reports.create') }}" class="btn btn-primary mb-3">Buat Laporan Baru</a>

    <div class="row">
        @foreach($reports as $report)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $report->image_path ? asset('storage/'.$report->image_path) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $report->title }}</h5>
                    <p class="card-text">{{ Str::limit($report->description, 100) }}</p>
                    <p><strong>Lokasi:</strong> {{ $report->location }}</p>
                    <a href="{{ route('reports.show', $report) }}" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
