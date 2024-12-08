<header id="header" class="header-scroll top-header headrom">
    <nav class="navbar navbar-dark">
        <div class="container">
            <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse"
                data-target="#mainNavbarCollapse">&#9776;</button>
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img class="img-rounded" src="{{ asset('images/gg.jpg') }}" alt="" width="20%">
            </a>
            <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                <ul class="nav navbar-nav">

                    @guest
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link active">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link active">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link active">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('records') }}" class="nav-link active">Welcome, {{ Auth::user()->name }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link active">Home</a>
                        </li>
                        @if (auth()->user()->hasRole('cashier'))
                            <li class="nav-item">
                                <a href="{{ route('records') }}" class="nav-link active">Records</a>
                            </li>
                        @elseif (auth()->user()->hasRole('user'))
                            <li class="nav-item">
                                <a href="{{ route('orders') }}" class="nav-link active">My Orders</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('menu') }}" class="nav-link active">Menu</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link active"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
