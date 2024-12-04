<nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Weathrly">
            <span>WEATHRLY</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('report')}}">Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('heat')}}">Heat</a>
                </li>
                <li class="nav-item d-flex flex-row ">
                    <div class="d-flex flex-column ">
                        <a class="nav-link pb-0" href="#">
                            John Doe
                        </a>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                        </form>
                    </div>
                    <div class="d-flex align-self-center">
                        <span class="ms-2">
                            <img src="{{ asset('images/profile.png') }}" alt="Profile Icon" class="rounded-circle profile-icon">
                        </span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>