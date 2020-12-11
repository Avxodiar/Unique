@extends('admin.layouts.layout')

@section('nav-button')
  <a class="btn btn-outline-primary" href="{{ route('logout') }}">Logout</a>
@endsection

@section('header')
  @include('admin.layouts.header')
@endsection

@section('content')

@endsection
