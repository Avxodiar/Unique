<div class="container">
    <div class="header_box">
        <div class="logo"><a href="#"><img src="{{ asset('assets/img/logo.png') }}" alt="logo"></a></div>
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div id="main-nav" class="collapse navbar-collapse navStyle">
                @yield('main-menu')
            </div>
        </nav>
    </div>
</div>
