<section id="portfolio" class="content">
    <!-- Container -->
    @if(!empty($portfolios) && is_array($portfolios))
    <div class="container portfolio_title">
        <!-- Title -->
        <div class="section-title">
            <h2>
                {{ (!empty($menu['portfolio'])) ? $menu['portfolio'] : 'Portfolio' }}
            </h2>
        </div>
        <!--/Title -->
    </div>
    <!-- Container -->
    @endif

    <div class="portfolio-top"></div>


    <div class="portfolio">

        <!-- Portfolio Filters -->
        <div id="filters" class="sixteen columns">
            <ul class="clearfix">
                <li>
                    <a id="all" href="#" data-filter="*" class="active">
                        <h5>All</h5>
                    </a>
                </li>
                @foreach($portfolioTags as $tag => $tagName)
                <li>
                    <a class="" href="#" data-filter=".{{ $tag }}">
                        <h5>{{ $tagName }}</h5>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <!--/Portfolio Filters -->

        <!-- Portfolio Wrapper -->
        <style>
            .portfolio-item11 {
                transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1);
            }
            .portfolio-item12 {
                transform: translate3d(337px, 0px, 0px) scale3d(1, 1, 1);
            }
            .portfolio-item13 {
                transform: translate3d(674px, 0px, 0px) scale3d(1, 1, 1);
            }
            .portfolio-item14 {
                transform: translate3d(1011px, 0px, 0px) scale3d(1, 1, 1);
            }
            .portfolio-item21 {
                transform: translate3d(0px, 240px, 0px) scale3d(1, 1, 1);
            }
            .portfolio-item22 {
                transform: translate3d(337px, 240px, 0px) scale3d(1, 1, 1);
            }
            .portfolio-item23 {
                transform: translate3d(674px, 240px, 0px) scale3d(1, 1, 1);
            }
            .portfolio-item24 {
                transform: translate3d(1011px, 240px, 0px) scale3d(1, 1, 1);
            }
        </style>
        <div class="isotope fadeInLeft animated wow portfolio-wrapper" id="portfolio_wrapper">

        @foreach($portfolios as $key => $portfolio)
            <!-- Portfolio Item -->
            <div class="portfolio-item portfolio-item-position portfolio-item{{(int) ($key/4)+1}}{{(int) ($key%4)+1}} one-four   {{ $portfolio['filters'] }} isotope-item">
                <div class="portfolio_img">
                    {!! Html::image('assets/img/' . $portfolio['image'], $portfolio['name']) !!}
                </div>
                <div class="item_overlay">
                    <div class="item_info">
                        <h4 class="project_name">{{ $portfolio['name'] }}</h4>
                    </div>
                </div>
            </div>
            <!--/Portfolio Item -->
        @endforeach
        </div>
        <!--/Portfolio Wrapper -->

    </div>
    <!--/Portfolio Filters -->

    <div class="portfolio_btm"></div>


    <div id="project_container">
        <div class="clear"></div>
        <div id="project_data"></div>
    </div>

</section>
