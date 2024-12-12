@extends('layout.app')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="position:absolute; top:370px; z-index:500;">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="position:absolute; z-index:500;">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container py-2 mt-5" style="max-width:600px;">
    <div class="row justify-content-center" style="margin-top:150px;">
        <div class="col-md-8">
            @if($user->profile_picture)
            <div class="mt-3 text-center d-flex justify-content-center">
                <div class="profile-picture-container" style="width: 250px; height: 250px; overflow: hidden; border-radius: 10px;position:absolute; top:150px; z-index:100;">
                    <img src="{{ Storage::disk('s3')->url(Auth::user()->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 100%; height: 100%;object-fit: cover; border: solid 15px #212529;">
                </div>
            </div>
            @endif
            <div class="card shadow">
                <div class="card-header bg-dark text-white">
                    <h2 class="mb-0 h3" style="font-weight:400;"></h2>
                </div>
                <div class="card-body">


                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3" style="margin-top:100px;">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $user->age) }}" required>
                            @error('age')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">

                            @error('profile_picture')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end" style="width:100%;"><button type="submit" class="btn btn-warning rounded-pill btn-sm" style="position:relative; top:30px; ">Update Profile</button></div>
                    </form>
                    <div class="d-flex justify-content-start align-items-start">
                        @if(Auth::user()->profile_picture)
                        <form action="{{ route('profile.picture.delete') }}" method="POST" class="ms-0 align-items-end">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remove Profile Picture</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection