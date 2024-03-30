<div class="header">

    <div class="header-left">
        <a href="{{ route('dashboard') }}" class="logo">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-small">
            <img src="{{ asset('assets/img/logo-small.png') }}" alt="Logo" width="30" height="30">
        </a>
    </div>

    <div class="menu-toggle">
        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-bars"></i>
        </a>
    </div>

    <a class="mobile_btn" id="mobile_btn">
        <i class="fas fa-bars"></i>
    </a>

    <ul class="nav user-menu">
        <li class="nav-item dropdown noti-dropdown language-drop me-2">
            <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                <img src="{{ asset('assets/img/icons/header-icon-01.svg') }}" alt="">
            </a>
            <div class="dropdown-menu ">
                <div class="noti-content">
                    <div>
                        <a class="dropdown-item" href="javascript:;"><i class="flag flag-lr me-2"></i>English</a>
                        <a class="dropdown-item" href="javascript:;"><i class="flag flag-bl me-2"></i>Arabic</a>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown noti-dropdown me-2">
            <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                <img src="{{ asset('assets/img/icons/header-icon-05.svg') }}" alt="">
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="#">
                                <div class="media d-flex">
                                    <span class="avatar avatar-sm flex-shrink-0">
                                        <img class="avatar-img rounded-circle" alt="User Image"
                                            src="assets/img/profiles/avatar-02.jpg">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                            approved <span class="noti-title">your estimate</span></p>
                                        <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                {{--  <div class="topnav-dropdown-footer">
                    <a href="#">View all Notifications</a>
                </div>  --}}
            </div>
        </li>

        <li class="nav-item zoom-screen me-2">
            <a href="#" class="nav-link header-nav-list win-maximize">
                <img src="{{ asset('assets/img/icons/header-icon-04.svg') }}" alt="">
            </a>
        </li>

        <li class="nav-item dropdown has-arrow new-user-menus">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" src="{{ Auth()->user()->getFirstMediaUrl('profileUser') }}" width="31"
                        alt="Soeng Souy">
                    <div class="user-text">
                        <h6>{{ Auth()->user()->name }}</h6>
                    </div>
                </span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('show_lawyer' , Auth()->user()->id) }}">My Profile</a>

                @if (Auth::check())
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out" style="font-size:24px"></i> Logout
                    </a>
                    <form method="POST" id="logout-form" action="{{ route('logout') }}">
                        @csrf
                    </form>
                @else
                    <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
                        <i class="me-50" data-feather="log-in"></i> Login
                    </a>
                @endif


            </div>
        </li>

    </ul>

</div>


<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <li>
                    <a href="{{ route('dashboard') }}"> Dashboard</a>
                </li>

                <li>
                    <a href="{{ route('list_practieces') }}"> practieces </a>
                </li>

                <li>
                    <a href="{{ route('list_lawyers') }}"> Lawyers </a>
                </li>

                <li>
                    <a href="{{ route('list_clients') }}"> clients </a>
                </li>


                <li>
                    <a href="{{ route('list_consultations') }}"><span> consultations</span></a>
                </li>

                <li>
                    <a href="{{ route('list_general_questions') }}"><span> General Questions </span></a>
                </li>

                <li>
                    <a href="{{ route('list_join_us') }}"><span> Requests to join </span></a>
                </li>


            </ul>
        </div>
    </div>
</div>
