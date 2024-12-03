@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Daftar Laporan Lingkungan</h2>

    <!-- Form Pencarian -->
    <form action="{{ route('reports.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari laporan berdasarkan judul atau lokasi" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @forelse($reports as $report)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $report->image_path ? asset('storage/'.$report->image_path) : 'https://via.placeholder.com/150' }}" class="card-img-top" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $report->title }}</h5>
                    <p class="card-text">{{ Str::limit($report->description, 100) }}</p>
                    <p><strong>Lokasi:</strong> {{ $report->location_name }}</p>
                    <a href="{{ route('reports.show', $report) }}" class="btn btn-primary">Lihat Detail</a>
                    <div class="d-flex justify-content-center mt-4">
                         {{ $reports->links() }}
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p>Tidak ada laporan ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection
