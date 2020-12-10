<section id="services" class="paddind-top60 bg-lightgray">
    <div class="container">
    @if(!empty($services) && is_array($services))
        <h2>
            {{ (!empty($menu['services'])) ? $menu['services'] : 'Services' }}
        </h2>
        <div class="service_wrapper">
            @foreach($services as $key => $service)
                @if( $key%3 === 0)
                <div class="row {{ ($key !== 0) ? 'borderTop' : '' }}">
                @endif
                    <div class="col-lg-4 {{ ($key%3 !== 0) ? 'borderLeft' : '' }} {{ ($key > 2) ? 'mrgTop' : '' }}">
                        <div class="service_block">
                            <div class="service_icon delay-03s animated wow  zoomIn">
                                <span><i class="fa {{ $service['icon'] }}"></i></span>
                            </div>
                            <h3 class="animated fadeInUp wow">{{ $service['name'] }}</h3>
                            <p class="animated fadeInDown wow">{{ $service['text'] }}</p>
                        </div>
                    </div>
                @if( $key%3 === 2)
                </div>
                @endif
            @endforeach
        </div>
    @endif
    </div>
</section>
