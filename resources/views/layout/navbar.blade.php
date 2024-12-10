<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/navbarStyle.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css" rel="stylesheet">
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

        .nav-buttons {
            padding-left: 13%;
        }


        .nav-hover {
            transition: color 0.3s ease;
        }

        /* Hover Styling */
        .nav-hover:hover {
            color: gray !important;
        }

        .profile-picture {
            width: 60px;
            /* Perbesar ukuran gambar */
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-name {
            position: relative;
            top: 10%;
            /* Geser nama ke bawah */
            left: 12%;
            /* Geser nama ke kiri */
            font-size: 16px;
            /* Ukuran teks */
        }

        .logout-button {
            background: none;
            border: none;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: color 0.3s ease;
            /* Tambahkan animasi perubahan warna */
        }

        /* Hover Effect for Logout Button */
        .logout-button:hover {
            color: red;
            /* Ubah warna menjadi merah */
            background: none;
        }

        .logout-button:focus {
            outline: none;
            /* Hilangkan outline saat fokus */
        }

        /* Name and Logout Button Spacing */
        .d-flex.flex-column {
            gap: 0px;
            /* Menghilangkan jarak antara nama dan logout button */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top">
        <div class="container">
            <!-- Logo and Brand Name -->
            <a class="navbar-brand d-flex align-items-center" href="/landing">
                <img src="https://weathrly.s3.ap-southeast-2.amazonaws.com/logo.png" alt="Weathrly" style="width: 40px; height: 40px;">
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
                        <div class="user-info d-flex flex-column align-items-end">
                            <a class="user-name nav-link text-white mb-0 px-4 pb-0" href="/profile/edit" style="font-family: 'Inter', sans-serif; font-size: 1.8vh; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight:1000;">
                                {{ Str::limit(Auth::user()->username, 15) }} <!-- Limit name to 15 characters -->
                            </a>
                            <a class="btn btn-sm btn-outline-light logout-button pt-0" href="{{ route('logout') }}" style="font-size: 1.7vh;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="/profile/edit">
                            @if(Auth::user()->profile_picture)
                            <img src="{{ Storage::disk('s3')->url(Auth::user()->profile_picture) }}" alt="Profile Picture" class="profile-picture">
                            @else
                            <img src="{{ Storage::disk('s3')->url('default-profile.jpg') }}" alt="Default Profile Picture" class="profile-picture">
                            @endif
                        </a>
                    </li>
                </ul>



            </div>
            @endauth
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>