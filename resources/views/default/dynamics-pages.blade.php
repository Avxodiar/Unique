@if(!empty($pages) && is_array($pages))
    @foreach($pages as $key => $page)
        {{-- Отображение секций осуществляется поочередно в стилистике секций home и about--}}
        @if($key%2 === 0)
            <!--Home_Section-->
            <section id="{{ $page['alias'] }}" class="top_cont_outer">
                <div class="hero_wrapper">
                    <div class="container">
                        <div class="hero_section">
                            <div class="row">
                                <div class="col-lg-5 col-sm-7">
                                    <div class="top_left_cont zoomIn wow animated">
                                        {!! $page['content'] !!}
                                        <a href="{{ route('page', ['alias' => $page['alias']]) }}" class="read_more2">Read more</a> </div>
                                </div>
                                <div class="col-lg-7 col-sm-5">
                                    {!! Html::image('assets/img/' . $page['images'], $page['name'], ['class' => 'zoomIn wow animated']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </section>
            <!--Home_Section-->
        @else
            <!--Aboutus-->
            <section id="{{ $page['alias'] }}" class="paddind-top60">
                <div class="inner_wrapper">
                    <div class="container">
                        <h2>{{ $page['name'] }}</h2>
                        <div class="inner_section">
                            <div class="row">
                                <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
                                    {!! Html::image('assets/img/' . $page['images'], $page['name'], ['class' => 'img-circle delay-03s animated wow zoomIn']) !!}
                                </div>
                                <div class=" col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
                                    <div class=" delay-01s animated fadeInDown wow animated">
                                        {!! $page['content'] !!}
                                    </div>
                                    <div class="work_bottom"> <span>Want to know more..</span> <a href="{{ route('page', ['alias' => $page['alias']]) }}" class="contact_btn">Contact Us</a> </div>
                                </div>

                            </div>


                        </div>
                    </div>
                    </div>
            </section>
            <!--Aboutus-->
        @endif
    @endforeach
@endif
