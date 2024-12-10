@extends('layout.app')

@section('content')
<div class="container py-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h2 class="mb-0 h3" style="font-weight:400;">Edit Profile</h2>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
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
                            @if($user->profile_picture)
                            <div class="mt-3 text-center">
                                <div class="profile-picture-container" style="width: 200px; height: 200px; overflow: hidden; border-radius: 10px; display: inline-block;">
                                    <img src="{{ Storage::disk('s3')->url(Auth::user()->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 100%; height: 100%;object-fit: cover;">
                                </div>
                            </div>
                            @endif
                            @error('profile_picture')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary" style="position:relative; top:40px;">Update Profile</button>
                    </form>
                    <div class="d-flex justify-content-end align-items-end">
                        @if(Auth::user()->profile_picture)
                        <form action="{{ route('profile.picture.delete') }}" method="POST" class="ms-0 align-items-end">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove Profile Picture</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection