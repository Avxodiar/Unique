<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Unique | Панель управления</title>

    <link rel="icon" href="{{ asset('assets/favicon.png') }}" type="image/png">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/css/admin/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/admin/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" type="text/css">

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

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Удаление элемента #<span></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Вы действительно хотите удалить элемент с именем<br> "<span></span>" ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="submit" id="modalSubmit" class="btn btn-danger">Удалить</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/admin/jquery-3.5.1.slim.min.js') }}"></script>
<script src="{{ asset('assets/js/admin/bootstrap.bundle.min.js') }}"></script>

<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>

<script src="{{ asset('assets/js/admin/script.js') }}"></script>

</body>
</html>
