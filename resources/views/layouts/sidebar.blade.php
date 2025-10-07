<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger"><a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none"
                data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a><a href="#"
                class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a></div>
        <div class="nk-sidebar-brand"><a href="{{ route('dashboard') }}" class="logo-link nk-sidebar-logo"><img
                    class="logo-light logo-img" src="images/logo.png" srcset="/demo1/images/logo2x.png 2x"
                    alt="logo"><img class="logo-dark logo-img" src="images/logo-dark.png"
                    srcset="/demo1/images/logo-dark2x.png 2x" alt="logo-dark"></a></div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Dashboards</h6>
                    </li>
                    <li class="nk-menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"><a href="{{ route('dashboard') }}" class="nk-menu-link"><span
                                class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span><span
                                class="nk-menu-text">Dashboard</span></a></li>
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Management</h6>
                    </li>
                    <li class="nk-menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}"><a href="{{ route('users.index') }}" class="nk-menu-link"><span
                                class="nk-menu-icon"><em class="icon ni ni-users"></em></span><span
                                class="nk-menu-text">Users</span></a></li>

                    <li class="nk-menu-item {{ request()->routeIs('fixtures.*') ? 'active' : '' }}"><a href="{{ route('fixtures.index') }}" class="nk-menu-link"><span
                                class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span><span
                                class="nk-menu-text">Fixtures</span></a>

                    </li>
                    <li class="nk-menu-item {{ request()->routeIs('matches.*') ? 'active' : '' }}"><a href="{{ route('matches.index') }}" class="nk-menu-link"><span
                                class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span><span
                                class="nk-menu-text">Matches</span></a></li>
                    <li class="nk-menu-item {{ request()->routeIs('clubs.*') ? 'active' : '' }}"><a href="{{ route('clubs.index') }}" class="nk-menu-link"><span
                                class="nk-menu-icon"><em class="icon ni ni-img"></em></span><span
                                class="nk-menu-text">clubs</span></a></li>
                    <li class="nk-menu-item {{ request()->routeIs('players.*') ? 'active' : '' }}"><a href="{{ route('players.index') }}" class="nk-menu-link"><span
                                class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span><span
                                class="nk-menu-text">Players</span></a></li>
                    <li class="nk-menu-item {{ request()->routeIs('staff.*') ? 'active' : '' }}"><a href="{{ route('staff.index') }}" class="nk-menu-link"><span
                                class="nk-menu-icon"><em class="icon ni ni-img"></em></span><span
                                class="nk-menu-text">staff</span></a></li>
                    <li class="nk-menu-item {{ request()->routeIs('stadiums.*') ? 'active' : '' }}"><a href="{{ route('stadiums.index') }}" class="nk-menu-link"><span
                                class="nk-menu-icon"><em class="icon ni ni-view-col"></em></span><span
                                class="nk-menu-text">stadiums</span></a></li>
                    <li class="nk-menu-item {{ request()->routeIs('licenses.*') ? 'active' : '' }}"><a href="{{ route('licenses.index') }}" class="nk-menu-link"><span
                                class="nk-menu-icon"><em class="icon ni ni-img"></em></span><span
                                class="nk-menu-text">licenses</span></a></li>
                    <li class="nk-menu-item {{ request()->routeIs('player_transfers.*') ? 'active' : '' }}"><a href="{{ route('player_transfers.index') }}" class="nk-menu-link"><span
                                class="nk-menu-icon"><em class="icon ni ni-img"></em></span><span
                                class="nk-menu-text">player transfers</span></a></li>

                </ul>
            </div>
        </div>
    </div>
</div>