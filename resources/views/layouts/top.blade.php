<div class="topbar">

<!-- LOGO -->
<div class="topbar-left">
    <a href="index.html" class="logo">
        <span class="logo-light">
            <i class="mdi mdi-camera-control"></i> Employee Manager
        </span>
        <span class="logo-sm">
            <i class="mdi mdi-camera-control"></i>
        </span>
    </a>
</div>
<nav class="navbar-custom">
    <ul class="navbar-left list-inline float-left mb-0">
    <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
                <div class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <span style="font-size: 16px;font-weight: 600;">
                        @yield('pageTitle')
                    <span>
                </div>   
            </div>
        </li>
    </ul>
    <ul class="navbar-right list-inline float-right mb-0">
        <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
                <div class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @auth
                        <span>Welcome</span> <b>{{ auth()->user()->name }}</b></span>
                    @endauth
                </div>   
            </div>
        </li>
        <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
                <div class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    @auth
                         <span>Vai trò: {{ get_user_role(auth()->user()->role) }}</span></span>
                    @endauth
                </div>   
            </div>
        </li>
        <li class="dropdown notification-list list-inline-item">
            <a class="dropdown-item text-danger" href="/logout"><i class="mdi mdi-power text-danger"></i> Logout</a>
        </li>
    </ul>
</nav>
</div>