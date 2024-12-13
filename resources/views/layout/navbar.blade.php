<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

        .navbar {
            margin-top: 15px;
            z-index: 500;
        }

        .navbar-brand span {
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            font-size: 18px;
        }

        .btn-outline-light {
            padding: 0.3rem 0.7rem;
            font-size: 14px;
        }

        .nav-hover {
            transition: color 0.3s ease;
        }

        .nav-hover:hover {
            color: gray !important;
        }

        .profile-picture {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .d-flex.flex-column {
            gap: 0px;
        }

        .nav-center {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .navbar-toggler {
            z-index: 1051;
        }

        /* .logout-button {
            background: none;
            border: none;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: color 0.3s ease;
        }

        .logout-button:hover {
            color: red;
            background: none;
        }

        .logout-button:focus {
            outline: none;
            background: none;
        }

        .logout-button:active {
            background: none;
            /* Ensures no background color when the button is clicked */
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top">
        <div class="container position-relative">
            <!-- Hamburger Menu -->
            <button class="navbar-toggler" type="button" id="navbar-toggler">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Logo and Brand Name -->
            <a class="navbar-brand d-flex align-items-center" href="/landing">
                <img src="https://weathrly.s3.ap-southeast-2.amazonaws.com/logo.png" alt="Weathrly" style="width: 40px; height: 40px;">
                <span class="ms-2 d-none d-lg-block" style="font-family: 'Inter', sans-serif; font-size: 20px;">WEATHRLY</span>
            </a>

            @auth
            <!-- Collapsible Menu (Visible on small screens) -->
            <div class="collapse position-absolute top-100 start-25 text-dark bg-white w-50 d-lg-none rounded-2 py-2" id="navbarNav" style="z-index: 1050;">
                @if(Auth::user()->role == 'user')
                <ul class="navbar-nav text-start ps-4" style="font-family: 'Inter', sans-serif;">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold nav-hover" href="{{ route('landing') }}">HOME</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold nav-hover" href="/reportHome">REPORT</a>
                    </li>
                </ul>
                @elseif(Auth::user()->role == 'admin')
                <ul class="navbar-nav text-start ps-4" style="font-family: 'Inter', sans-serif;">
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold nav-hover" href="{{ route('dashboard') }}">DASHBOARD</a>
                    </li>
                    
                        <hr class="m-0 p-0 w-75" style="height:min-content;">
                    
                    <li class="nav-item">
                        <a class="nav-link text-dark fw-bold nav-hover" href="/reportHome">REPORT</a>
                    </li>
                </ul>
                @endif
            </div>

            <!-- Regular Menu (Visible on large screens) -->
            <div class="d-none d-lg-block nav-center" style="font-family: 'Inter', sans-serif;">
                @if(Auth::user()->role == 'user')
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold nav-hover" href="{{ route('landing') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold nav-hover" href="/reportHome">REPORT</a>
                    </li>
                </ul>
                @elseif(Auth::user()->role == 'admin')
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold nav-hover" href="{{ route('dashboard') }}">DASHBOARD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold nav-hover" href="/reportHome">REPORT</a>
                    </li>
                </ul>
                @endif
            </div>

            <!-- Profile Section -->
            <div class="d-flex flex-row ms-auto align-items-center">
                <div class="user-info d-flex flex-column align-items-end justify-content-end me-2">
                    <a class="user-name nav-link text-white nav-hover mb-0 py-0 m-0" href="/profile/edit" style="font-family: 'Inter', sans-serif; font-size: 2.5vh; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight:1000;">
                        {{ Str::limit(Auth::user()->username, 13) }}
                    </a>
                    <a class=" bg-white link link-danger px-2 py-0 m-0 fw-bold text-danger link-underline-opacity-0 rounded-pill" href="{{ route('logout') }}" style="font-size: 1.5vh;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        LOGOUT
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                <a href="/profile/edit" class="ms-0">
                    @if(Auth::user()->profile_picture)
                    <img src="{{ Storage::disk('s3')->url(Auth::user()->profile_picture) }}" alt="Profile Picture" class="profile-picture" style="border: solid 2px white;">
                    @else
                    <img src="{{ Storage::disk('s3')->url('default-profile.jpg') }}" alt="Default Profile Picture" class="profile-picture" style="border: solid 2px white;">
                    @endif
                </a>
            </div>
            @endauth
        </div>
    </nav>

    <script>
        // JavaScript to toggle the navbar
        document.getElementById('navbar-toggler').addEventListener('click', function() {
            const navbarNav = document.getElementById('navbarNav');
            navbarNav.classList.toggle('show');
        });
    </script>
</body>

</html>