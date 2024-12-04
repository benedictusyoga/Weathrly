@extends('layout.app')

@section('content')
<div class="container">
    <h1>Edit Profile</h1>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $user->age) }}" required>
            @error('age')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
            @if($user->profile_picture)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" class="img-thumbnail" style="max-width: 150px;">
            </div>
            @endif
            @error('profile_picture')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
    @if(Auth::user()->profile_picture)
    <form action="{{ route('profile.picture.delete') }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE') <!-- This tells Laravel to treat the request as DELETE -->
        <button type="submit" class="btn btn-danger">Remove Profile Picture</button>
    </form>
    @endif
</div>
@endsection