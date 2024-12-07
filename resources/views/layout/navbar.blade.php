<link href="{{ asset('css/navbarStyle.css') }}" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <div class="container">
        <!-- Logo and Brand Name -->
        <a class="navbar-brand d-flex align-items-center" href="/landing">
            <img src="{{ asset('images/logo.png') }}" alt="Weathrly" style="width: 40px; height: 40px;">
            <span class="ms-2" style="font-family: 'Inter', sans-serif; font-size: 20px;">WEATHRLY</span>
        </a>
        @auth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto nav-buttons" style="font-family: 'Inter', sans-serif;">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold nav-hover" href="{{ route('landing') }}">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold nav-hover" href="/reportHome">REPORT</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item d-flex align-items-center">
                    <div class="user-info d-flex flex-column align-items-start">
                        <a class="user-name nav-link text-white mb-0 p-0" href="/profile/edit" style="font-family: 'Inter', sans-serif;">
                            {{ Auth::user()->name }}
                        </a>
                        <a class="btn btn-sm btn-outline-light logout-button" href="{{ route('logout') }}" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <a href="/profile/edit">
                        @if(Auth::user()->profile_picture)
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="profile-picture">
                        @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="profile-picture">
                        @endif
                    </a>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</nav>