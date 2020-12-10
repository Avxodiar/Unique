@extends('default.layouts.layout')

@section('main-menu')
    @include('default.main-menu')
@endsection

@section('content')
    @section('dynamics-pages')
        @include('default.dynamics-pages')
    @show

    <!--Service-->
    @section('services')
        @include('default.services')
    @show
    <!--Service-->

    <!-- Portfolio -->
    @section('portfolios')
        @include('default.portfolios')
    @show
    <!--/Portfolio -->

    <!--client_logos-->
    @section('clients')
        @include('default.clients')
    @show
    <!--client_logos-->

    @section('team')
        @include('default.team')
    @show
    <!--/Team-->
@endsection
