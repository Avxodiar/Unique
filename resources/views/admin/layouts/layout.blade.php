<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unique</title>

    <link rel="icon" href="{{ asset('assets/favicon.png') }}" type="image/png">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/admin/bootstrap.min.css')}}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{asset('assets/css/admin/floating-labels.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/admin/sticky-footer-navbar.css')}}" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

<header>
    @yield('header')
</header>

<main role="main" class="flex-shrink-0">
    <div class="container ">
        @yield('content')
    </div>
</main>

<footer class="footer mt-auto py-3 bg-white border-top">
    <div class="container">
        <p>© 2020, Developed by <a href="#">avxodiar@gmail</a></p>
    </div>
</footer>

<script src="{{ asset('assets/js/admin/jquery-3.5.1.slim.min.js') }}"></script>
<script src="{{ asset('assets/js/admin/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
