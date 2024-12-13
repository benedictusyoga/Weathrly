<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laporan Lingkungan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"> -->

    <!-- <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
    </style> -->
</head>

<body style="margin: 0; padding: 0; background: url('https://weathrly.s3.ap-southeast-2.amazonaws.com/fabio-jock-pvh68_D9qqI-unsplash.jpg') no-repeat center center fixed;background-size: cover;">
    @include('layout.navbar')
    <div class="d-flex justify-content-center align-items-center flex-column" style="margin-top:80px;">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        .form-control:focus {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            border: none;
        }

        .neg-hover {
            transition: transform 0.1s ease;
        }

        .neg-hover:hover {
            transform: rotate(-10deg);
        }

        .pos-hover {
            transition: transform 0.1s ease;
        }

        .pos-hover:hover {
            transform: translateY(-10%);
        }

        .item-hover {
            transition: transform 0.1s ease;
        }

        .item-hover:hover {
            transform: translateY(-5%);
        }
    </style>
</body>

</html>