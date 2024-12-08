<div class="header">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <span><img src="{{ secure_asset('images/admin/admin.png') }}" alt="ADMIN" class="dark-logo" /></span>
            </a>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- Additional navigation items can be added here -->
            </ul>

            <ul class="navbar-nav my-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ secure_asset('images/admin/logout.png') }}" alt="user" class="profile-pic" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                        <ul class="dropdown-user">
                            <li>
                                <a href="{{ route('logout') }}">
                                    <i class="fa fa-power-off"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
