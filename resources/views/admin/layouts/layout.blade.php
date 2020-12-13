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
        .nav-tabs .nav-link.active {
            color: #df0031;
            font-weight: bold;
        }
        .min-w125 {
            min-width: 125px;
        }
        .current-img {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .visually-hidden {
            position:absolute;
            width:1px;
            height:1px;
            margin:-1px;
            border:0;
            clip:rect(0 0 0 0);
            overflow:hidden;
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


<script>
    var deleteForm = '';
    $( document ).ready(function() {
        // fix bootstrap отображения имени файла в у стилизованного поля загрузки файла
        $('.custom-file-input').on('change',function(evt){
            // var fileName = $(this).val();
            if(evt.target.files.length) {
                let fileName = evt.target.files[0].name;
                $(this).next('.custom-file-label').html(fileName);
            }
        });

        // радиоселектор выбранного поля
        // input text для указания имени файла
        // input file для загрузки файла
        $('#radio-text').on('click',function(){
            $('#input-image').prop( "disabled", false ).focus();
            $('#input-file').prop( "disabled", true );
            $('img.img-thumbnail').addClass('current-img');
        });
        $('#input-image').focusout(function(){
            $('img.img-thumbnail').removeClass('current-img');
        });
        $('#radio-file').on('click',function(){
            $('#input-file').prop( "disabled", false ).focus();
            $('#input-image').prop( "disabled", true );
        });

        // модальное окно подтверждения удаления элемента
        $('#deleteModal').on('show.bs.modal', function (evt) {
            deleteForm = $(evt.relatedTarget.parentElement);
            //link = event.relatedTarget.href;
            let button = $(evt.relatedTarget); // Button that triggered the modal
            let id = button.data('id'); // Extract info from data-* attributes
            let name = button.data('name'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            $(this).find('.modal-title span').text(id);
            $(this).find('.modal-body p span').text(name);
            $(this).trigger('focus');
        });

        // оправка формы для удаления элемента при подтверждении в модальном окне
        $('#modalSubmit').on('click', function () {
            deleteForm.submit();
        });

    });
</script>

</body>
</html>
