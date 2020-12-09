@yield('dynamics-pages')

<!--Service-->
<section  id="services">
    @section('services')
    <div class="container">
        <h2>Services</h2>
        <div class="service_wrapper">
            <div class="row">
                <div class="col-lg-4">
                    <div class="service_block">
                        <div class="service_icon delay-03s animated wow  zoomIn"> <span><i class="fa fa-android"></i></span> </div>
                        <h3 class="animated fadeInUp wow">Android</h3>
                        <p class="animated fadeInDown wow">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                    </div>
                </div>
                <div class="col-lg-4 borderLeft">
                    <div class="service_block">
                        <div class="service_icon icon2  delay-03s animated wow zoomIn"> <span><i class="fa fa-apple"></i></span> </div>
                        <h3 class="animated fadeInUp wow">Apple IOS</h3>
                        <p class="animated fadeInDown wow">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                    </div>
                </div>
                <div class="col-lg-4 borderLeft">
                    <div class="service_block">
                        <div class="service_icon icon3  delay-03s animated wow zoomIn"> <span><i class="fa fa-html5"></i></span> </div>
                        <h3 class="animated fadeInUp wow">Design</h3>
                        <p class="animated fadeInDown wow">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                    </div>
                </div>
            </div>
            <div class="row borderTop">
                <div class="col-lg-4 mrgTop">
                    <div class="service_block">
                        <div class="service_icon delay-03s animated wow  zoomIn"> <span><i class="fa fa-dropbox"></i></span> </div>
                        <h3 class="animated fadeInUp wow">Concept</h3>
                        <p class="animated fadeInDown wow">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                    </div>
                </div>
                <div class="col-lg-4 borderLeft mrgTop">
                    <div class="service_block">
                        <div class="service_icon icon2  delay-03s animated wow zoomIn"> <span><i class="fa fa-slack"></i></span> </div>
                        <h3 class="animated fadeInUp wow">User Research</h3>
                        <p class="animated fadeInDown wow">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                    </div>
                </div>
                <div class="col-lg-4 borderLeft mrgTop">
                    <div class="service_block">
                        <div class="service_icon icon3  delay-03s animated wow zoomIn"> <span><i class="fa fa-users"></i></span> </div>
                        <h3 class="animated fadeInUp wow">User Experience</h3>
                        <p class="animated fadeInDown wow">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @show
</section>
<!--Service-->

<!-- Portfolio -->
<section id="portfolio" class="content">
    @section('portfolio')
    <!-- Container -->
    <div class="container portfolio_title">

        <!-- Title -->
        <div class="section-title">
            <h2>Portfolio</h2>
        </div>
        <!--/Title -->

    </div>
    <!-- Container -->

    <div class="portfolio-top"></div>

    <!-- Portfolio Filters -->
    <div class="portfolio">

        <div id="filters" class="sixteen columns">
            <ul class="clearfix">
                <li><a id="all" href="#" data-filter="*" class="active">
                        <h5>All</h5>
                    </a></li>
                <li><a class="" href="#" data-filter=".prototype">
                        <h5>Prototype</h5>
                    </a></li>
                <li><a class="" href="#" data-filter=".design">
                        <h5>Design</h5>
                    </a></li>
                <li><a class="" href="#" data-filter=".android">
                        <h5>Android</h5>
                    </a></li>
                <li><a class="" href="#" data-filter=".appleIOS">
                        <h5>Apple IOS</h5>
                    </a></li>
                <li><a class="" href="#" data-filter=".web">
                        <h5>Web App</h5>
                    </a></li>
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

            <!-- Portfolio Item -->
            <div class="portfolio-item portfolio-item-position portfolio-item11 one-four   appleIOS isotope-item">
                <div class="portfolio_img"> <img src="{{ asset('assets/img/portfolio_pic1.jpg') }}"  alt="Portfolio 1"> </div>
                <div class="item_overlay">
                    <div class="item_info">
                        <h4 class="project_name">SMS Mobile App</h4>
                    </div>
                </div>
            </div>
            <!--/Portfolio Item -->

            <!-- Portfolio Item-->
            <div class="portfolio-item portfolio-item-position portfolio-item12 one-four  design isotope-item">
                <div class="portfolio_img"> <img src="{{ asset('assets/img/portfolio_pic2.jpg') }}" alt="Portfolio 1"> </div>
                <div class="item_overlay">
                    <div class="item_info">
                        <h4 class="project_name">Finance App</h4>
                    </div>
                </div>
            </div>
            <!--/Portfolio Item -->

            <!-- Portfolio Item -->
            <div class="portfolio-item portfolio-item-position portfolio-item13 one-four  design  isotope-item">
                <div class="portfolio_img"> <img src="{{ asset('assets/img/portfolio_pic3.jpg') }}" alt="Portfolio 1"> </div>
                <div class="item_overlay">
                    <div class="item_info">
                        <h4 class="project_name">GPS Concept</h4>
                    </div>
                </div>
            </div>
            <!--/Portfolio Item-->

            <!-- Portfolio Item-->
            <div class="portfolio-item portfolio-item-position portfolio-item14 one-four  android  prototype web isotope-item">
                <div class="portfolio_img"> <img src="{{ asset('assets/img/portfolio_pic4.jpg') }}" alt="Portfolio 1"> </div>
                <div class="item_overlay">
                    <div class="item_info">
                        <h4 class="project_name">Shopping</h4>
                    </div>
                </div>
            </div>
            <!-- Portfolio Item -->

            <!-- Portfolio Item -->
            <div class="portfolio-item portfolio-item-position portfolio-item21 one-four  design isotope-item">
                <div class="portfolio_img"> <img src="{{ asset('assets/img/portfolio_pic5.jpg') }}" alt="Portfolio 1"> </div>
                <div class="item_overlay">
                    <div class="item_info">
                        <h4 class="project_name">Managment</h4>
                    </div>
                </div>
            </div>
            <!--/Portfolio Item -->

            <!-- Portfolio Item -->
            <div class="portfolio-item portfolio-item-position portfolio-item22 one-four  web isotope-item">
                <div class="portfolio_img"> <img src="{{ asset('assets/img/portfolio_pic6.jpg') }}" alt="Portfolio 1"> </div>
                <div class="item_overlay">
                    <div class="item_info">
                        <h4 class="project_name">iPhone</h4>
                    </div>
                </div>
            </div>
            <!--/Portfolio Item -->

            <!-- Portfolio Item  -->
            <div class="portfolio-item portfolio-item-position portfolio-item23 one-four  design web isotope-item">
                <div class="portfolio_img"> <img src="{{ asset('assets/img/portfolio_pic7.jpg') }}" alt="Portfolio 1"> </div>
                <div class="item_overlay">
                    <div class="item_info">
                        <h4 class="project_name">Nexus Phone</h4>
                    </div>
                </div>
            </div>
            <!--/Portfolio Item -->

            <!-- Portfolio Item -->
            <div class="portfolio-item portfolio-item-position portfolio-item24 one-four   android isotope-item">
                <div class="portfolio_img"> <img src="{{ asset('assets/img/portfolio_pic8.jpg') }}" alt="Portfolio 1"> </div>
                <div class="item_overlay">
                    <div class="item_info">
                        <h4 class="project_name">Android</h4>
                    </div>
                </div>
                </a> </div>
            <!--/Portfolio Item -->

        </div>
        <!--/Portfolio Wrapper -->

    </div>
    <!--/Portfolio Filters -->

    <div class="portfolio_btm"></div>


    <div id="project_container">
        <div class="clear"></div>
        <div id="project_data"></div>
    </div>

    @show
</section>
<!--/Portfolio -->

<section id="clients" class="page_section" ><!--page_section-->
    @section('clients')
    <h2>Clients</h2>
    <!--page_section-->
    <div class="client_logos"><!--client_logos-->
        <div class="container">
            <ul class="fadeInRight animated wow">
                <li><a href="javascript:void(0)"><img src="{{ asset('assets/img/client_logo1.png') }}" alt=""></a></li>
                <li><a href="javascript:void(0)"><img src="{{ asset('assets/img/client_logo2.png') }}" alt=""></a></li>
                <li><a href="javascript:void(0)"><img src="{{ asset('assets/img/client_logo3.png') }}" alt=""></a></li>
                <li><a href="javascript:void(0)"><img src="{{ asset('assets/img/client_logo5.png') }}" alt=""></a></li>
            </ul>
        </div>
    </div>
    @show
</section>
<!--client_logos-->

<section id="team" class="page_section team"><!--main-section team-start-->
    @section('team')
    <div class="container">
        <h2>Team</h2>
        <h6>Lorem ipsum dolor sit amet, consectetur adipiscing.</h6>
        <div class="team_section clearfix">
            <div class="team_area">
                <div class="team_box wow fadeInDown delay-03s">
                    <div class="team_box_shadow"><a href="javascript:void(0)"></a></div>
                    <img src="{{ asset('assets/img/team_pic1.jpg') }}" alt="">
                    <ul>
                        <li><a href="javascript:void(0)" class="fa fa-twitter"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-facebook"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-pinterest"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-google-plus"></a></li>
                    </ul>
                </div>
                <h3 class="wow fadeInDown delay-03s">Tom Rensed</h3>
                <span class="wow fadeInDown delay-03s">Chief Executive Officer</span>
                <p class="wow fadeInDown delay-03s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consequat sollicitudin cursus. Dolor sit amet, consectetur adipiscing elit proin consequat.</p>
            </div>
            <div class="team_area">
                <div class="team_box  wow fadeInDown delay-06s">
                    <div class="team_box_shadow"><a href="javascript:void(0)"></a></div>
                    <img src="{{ asset('assets/img/team_pic2.jpg') }}" alt="">
                    <ul>
                        <li><a href="javascript:void(0)" class="fa fa-twitter"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-facebook"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-pinterest"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-google-plus"></a></li>
                    </ul>
                </div>
                <h3 class="wow fadeInDown delay-06s">Kathren Mory</h3>
                <span class="wow fadeInDown delay-06s">Vice President</span>
                <p class="wow fadeInDown delay-06s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consequat sollicitudin cursus. Dolor sit amet, consectetur adipiscing elit proin consequat.</p>
            </div>
            <div class="team_area">
                <div class="team_box wow fadeInDown delay-09s">
                    <div class="team_box_shadow"><a href="javascript:void(0)"></a></div>
                    <img src="{{ asset('assets/img/team_pic3.jpg') }}" alt="">
                    <ul>
                        <li><a href="javascript:void(0)" class="fa fa-twitter"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-facebook"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-pinterest"></a></li>
                        <li><a href="javascript:void(0)" class="fa fa-google-plus"></a></li>
                    </ul>
                </div>
                <h3 class="wow fadeInDown delay-09s">Lancer Jack</h3>
                <span class="wow fadeInDown delay-09s">Senior Manager</span>
                <p class="wow fadeInDown delay-09s">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin consequat sollicitudin cursus. Dolor sit amet, consectetur adipiscing elit proin consequat.</p>
            </div>
        </div>
    </div>
    @show
</section>
<!--/Team-->
