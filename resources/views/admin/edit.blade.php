@extends('admin.layouts.layout')

@section('nav-button')
    <a class="btn btn-outline-primary min-w125" href="{{ route('logout') }}">Выход</a>
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')

    @error('formError')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
            @if (session('id'))
                <br><a href="{{route('edit-' . $section , session('id'))}}">Изменить</a>
            @endif
        </div>
    @endif

    <div class="card mb-5">
        <div class="card-header bg-secondary text-light">
            <h2 class="h4 font-weight-normal">
                {{ $title }}
                @if (isset($id))
                #{{ $id }}
                @endif
            </h2>
        </div>
        <div class="card-body">

            @switch($section)

                @case('page')
                    @include('admin.page-form')
                @break

                @case('service')
                    @include('admin.service-form')
                @break

                @case('portfolio')
                @include('admin.portfolio-form')
                @break

                @case('people')
                    @include('admin.team-form')
                @break

            @endswitch

        </div>
    </div>

@endsection


