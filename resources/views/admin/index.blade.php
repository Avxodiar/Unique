@extends('admin.layouts.layout')

@section('nav-button')
  <a class="btn btn-outline-primary" href="{{ route('logout') }}">Logout</a>
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
            <a class="nav-link {{ $active['pages'] }}" href="{{ route('page-list') }}">Страницы</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $active['services'] }}" href="{{ route('service-list') }}">Услуги</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $active['portfolio'] }}" href="{{ route('portfolio-list') }}">Портфолио</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $active['team'] }}" href="{{ route('team-list') }}">Команда</a>
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
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="navbar my-2">
        <h2 class="h4 font-weight-normal">Список элементов</h2>
        <a class="btn btn-outline-primary" href="{{route('add-' . $section)}}" role="button">Добавить</a>
    </div>

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
                <td>
                    <a class="btn btn-outline-info" href="{{route('edit-' . $section, $element['id'])}}" role="button">Изменить</a>
                    <a class="btn btn-outline-danger" href="{{route('delete-' . $section, $element['id'])}}" role="button">Удалить</a>
                </td>
            </tr>
            @endforeach
             </tbody>
        </table>
    @endif

@endsection
