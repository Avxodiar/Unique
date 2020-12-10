@extends('default.layouts.layout')

@section('main-menu')
    @include('default.main-menu')
@endsection

@section('content')
    @if(!empty($page) && is_array($page))
    <section id="{{ $page['alias'] }}" class="paddind-top60">
        <div class="inner_wrapper">
            <div class="container">
                <h2>{{ $page['name'] }}</h2>
                <div class="inner_section">
                    <div class="row">
                        <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-left">
                            {!! Html::image('assets/img/' . $page['images'], $page['name'], ['class' => 'img-circle delay-03s animated wow zoomIn']) !!}
                        </div>
                        <div class=" col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-right">
                            <div class=" delay-01s animated fadeInDown wow animated">
                                {!! $page['content'] !!}
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>
    @endif
@endsection

@section('contact-form')
    @include('default.contact-form')
@endsection




