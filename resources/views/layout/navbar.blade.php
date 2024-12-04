<nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/landing">
            <img src="{{ asset('images/logo.png') }}" alt="Weathrly">
            <span>WEATHRLY</span>
        </a>
        @auth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/reportHome">Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('landing')}}">Home</a>
                </li>
                <li class="nav-item d-flex flex-row">
                    <div class="d-flex flex-column">
                        <a class="nav-link pb-0" href="/profile/edit">
                            {{ Auth::user()->name }}
                        </a>
                        <a class="btn btn-outline-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <div class="d-flex align-self-center">
                        <a class="ms-2" href="/profile/edit">
                            @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" style="width:50px; height:50px; border-radius:50%; object-fit: cover;">
                            @else
                            <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" style="width:50px; height:50px; border-radius:50%; object-fit: cover;">
                            @endif
                        </a>
                    </div>
                </li>
            </ul>
            @endauth

            @guest
            @endguest
        </div>
    </div>
</nav>