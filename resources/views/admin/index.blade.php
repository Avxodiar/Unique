@extends('admin.layouts.layout')

@section('nav-button')
  <a class="btn btn-outline-primary min-w125" href="{{ route('logout') }}">Выход</a>
@endsection

@section('header')
  @include('admin.layouts.header')
@endsection

@section('content')

    <ul class="nav nav-tabs mr-auto">
        <li class="nav-item ">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Разделы:</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $sectionActive['page'] }}" href="{{ route('page-list') }}">Страницы</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $sectionActive['service'] }}" href="{{ route('service-list') }}">Услуги</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $sectionActive['portfolio'] }}" href="{{ route('portfolio-list') }}">Портфолио</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $sectionActive['people'] }}" href="{{ route('people-list') }}">Команда</a>
        </li>
    </ul>

    @if (count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success mt-2">
            {{ session('status') }}
        </div>
    @endif

    @if (isset($section))
    <div class="navbar my-2">
        <h2 class="h4 font-weight-normal">Список элементов</h2>
        <a class="btn btn-outline-primary" href="{{route('add-' . $section)}}" role="button">Добавить</a>
    </div>
    @else
        <div class="alert alert-info mt-5" role="alert">
            <h4 class="alert-heading">Добро пожаловать!</h4>
            <p>Выберите раздел для добавления, изменения или удаления материалов</p>
            <hr>
            <p class="mb-0">Будьте аккуратны. Большинство операций имеет необратимый характер.</p>
        </div>
    @endif

    @if (!empty($list) && is_array($list))
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                @foreach($fields as $field)
                <th scope="col">{{ $field }}</th>
                @endforeach
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($list as $key => $element)
            <tr>
                <th scope="row">{{ $element['id'] }}</th>
                @foreach($fields as $key => $field)
                <td>{{ $element[$key] }}</td>
                @endforeach
                <td class="d-flex justify-content-around">
                    <a class="btn btn-outline-info" href="{{route('edit-' . $section, $element['id'])}}" role="button">Изменить</a>

                    <form action="{{route('delete-' . $section, $element['id'])}}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" value="{{ $element['id'] }}">
                        <a class="btn btn-outline-danger" role="button"
                           href="{{route('delete-' . $section, $element['id'])}}"
                           data-toggle="modal" data-target="#deleteModal"
                           data-id="{{ $element['id'] }}" data-name="{{ $element['name'] }}">Удалить</a>
                    </form>
                </td>
            </tr>
            @endforeach
             </tbody>
        </table>
    @endif

@endsection
