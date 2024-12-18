@extends('layout.app')

@section('content')
<div class="d-flex justify-content-center flex-column align-items-center" style="height:85vh;">
    @auth
    <div class="main-box @guest guest-mode @endguest mx-5" style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; color: white; text-align: center;">
        <h1 class="display-1 fw-bold">Welcome, <span>{{ Str::limit(Auth::user()->name, 10) }}</span></h1>
        <p>What are we doing today?</p>
        <div class="d-flex flex-row justify-content-center align-items-center" style="gap:20px;">
            
            <a class="btn btn-primary" href="{{ route('manageuser') }}">View Users</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger" type="submit">Logout</button>
            </form>
        </div>
    </div>
    @endauth
</div>
@endsection