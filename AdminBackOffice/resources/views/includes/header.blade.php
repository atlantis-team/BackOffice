<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-5">
    <div class="container">
        <!-- Brand button -->
        <a class="navbar-brand mb-0 h1 font-weight-bold" href="{{ route('home') }}">
            <img src="images/algeco.jpg" height="30" class="d-inline-block align-top mr-2">
            Atlantis Back Office
        </a>

        <!-- Mobile menu switch button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Desktop menu buttons -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!-- Home button -->
                <li class="nav-item {{ Request::is('/') ? 'active font-weight-bold' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <!-- Devices button -->
                <li class="nav-item {{ Request::is('devices') ? 'active font-weight-bold' : '' }}">
                    <a class="nav-link" href="{{ route('devices') }}">Devices</a>
                </li>
            </ul>
        @if(!Auth::check())
            <!-- Login button -->
                <span class="nav-link d-none d-lg-block text-danger font-weight-bold">
                    Login system disabled for PoC only
                </span>
                <a class="btn btn-sm btn-outline-primary nav-link" href="{{route('login')}}">Login</a>
        @else
            <!-- Logoff button -->
                <span class="nav-link d-none d-lg-block">
                    Connected as ADMIN
                </span>
                <a class="btn btn-sm btn-outline-danger nav-link" href="{{route('logout')}}">Logout</a>
            @endif

        </div>
    </div>
</nav>
