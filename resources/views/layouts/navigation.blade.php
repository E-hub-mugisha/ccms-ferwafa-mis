<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1"><a href="#"
                    class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                        class="icon ni ni-menu"></em></a></div>
            <div class="nk-header-brand d-xl-none"><a href="index.html" class="logo-link"><img
                        class="logo-light logo-img" src="images/logo.png"
                        srcset="/demo1/images/logo2x.png 2x" alt="logo"><img class="logo-dark logo-img"
                        src="images/logo-dark.png" srcset="/demo1/images/logo-dark2x.png 2x"
                        alt="logo-dark"></a></div>
            <div class="nk-header-news d-none d-xl-block">
                <div class="nk-news-list">
                    <a class="nk-news-item" href="#">
                        <div class="nk-news-icon"><em class="icon ni ni-card-view"></em></div>
                        <div class="nk-news-text">
                            <p>Do you know the latest update of 2022? <span> A overview of our is now
                                    available on YouTube</span></p><em class="icon ni ni-external"></em>
                        </div>
                    </a>
                </div>
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown"><a href="#" class="dropdown-toggle"
                            data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm"><em class="icon ni ni-user-alt"></em></div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-status">Administrator</div>
                                    <div class="user-name dropdown-indicator">{{ Auth::user()->name }}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar"><span>AB</span></div>
                                    <div class="user-info"><span class="lead-text">{{ Auth::user()->name }}</span><span
                                            class="sub-text">{{ Auth::user()->email }}</span></div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><em class="icon ni ni-signout"></em><span>Sign
                                                    out</span>
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown notification-dropdown me-n1">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="icon-status icon-status-info">
                                <em class="icon ni ni-bell"></em>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                <form action="{{ route('notifications.markAll') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 text-primary">Mark All as Read</button>
                                </form>
                            </div>

                            <div class="dropdown-body">
                                <div class="nk-notification">
                                    @forelse($notifications as $notif)
                                    @php
                                    $color = match($notif->type) {
                                    'success' => 'bg-success-dim',
                                    'warning' => 'bg-warning-dim',
                                    'danger' => 'bg-danger-dim',
                                    default => 'bg-info-dim'
                                    };
                                    @endphp
                                    <div class="nk-notification-item dropdown-inner {{ $notif->is_read ? 'opacity-75' : '' }}">
                                        <div class="nk-notification-icon">
                                            <em class="icon icon-circle {{ $color }} ni ni-bell"></em>
                                        </div>
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">
                                                <strong>{{ $notif->title }}</strong> — {{ $notif->message }}
                                            </div>
                                            <div class="nk-notification-time">
                                                {{ $notif->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <p class="text-center text-muted my-3">No notifications</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="dropdown-foot center"><a href="#">View All</a></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>