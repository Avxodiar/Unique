@extends('admin.layouts.layout')

@section('nav-button')
    <a class="btn btn-outline-primary" href="{{ route('registration') }}">Register</a>
@endsection

@section('header')
    @include('admin.layouts.header')
@endsection

@section('content')
<div class="d-flex justify-content-center my-5">
    <div class="w-50 text-center align-self-center">

        <h1 class="h3 mb-3 font-weight-normal">{{ $title }}</h1>

        <form class="form-signin" action="{{ route('login') }}" method="post">

            {{ csrf_field() }}

            @error('formError')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-label-group">
                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email адрес" required autofocus value="{{ old('email') }}">
                <label for="inputEmail">Email адрес</label>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-label-group">
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
                <label for="inputPassword">Пароль</label>
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input name="remember" type="checkbox" value="{{ old('remember') }}"> Запомнить меня
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>

        </form>
    </div>
</div>
@endsection
