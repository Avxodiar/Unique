<nav class="navbar navbar-expand-md navbar-white bg-white border-bottom shadow-sm">
    <div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
        </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link font-weight-bold button-red" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold" href="{{ route('admin') }}">Admin <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <nav class="m0">
            <h1 class="h4 font-weight-normal">{{ $title }}</h1>
        </nav>

        <nav class="my-2 my-md-0 mr-md-3 ml-auto">
            @yield('nav-button')
        </nav>
    </div>
</nav>
