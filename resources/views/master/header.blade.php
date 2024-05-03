<div class="header">
    @php
        $encodedId = base64_encode(Auth()->user()->id);
    @endphp
    @role('admin')
        <div class="header-left">
            <a href="{{ route('dashboard') }}" class="logo">
                <img class="img-fluid" src="{{ asset('img/logo.jpeg') }}" alt="Logo">
                <h1 class="logo-text">Breifcase</h1>
            </a>
            <a href="{{ route('dashboard') }}" class="logo logo-small">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" width="30" height="30">
            </a>
        </div>
    @endrole
    @role('lawyer|typingCenter|legalConsultant')
        <div class="header-left">
            <a href="{{ route('dashboardLawyer') }}" class="logo">
                <img class="img-fluid" src="{{ asset('img/logo.jpeg') }}" alt="Logo">
                <h1 class="logo-text">Breifcase</h1>
            </a>
            <a href="{{ route('dashboardLawyer') }}" class="logo logo-small">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" width="30" height="30">
            </a>
        </div>
    @endrole

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
                        <a class="dropdown-item" href={{ route('lang' ,'en') }}><i class="flag flag-lr me-2"></i>English</a>
                        <a class="dropdown-item" href={{ route('lang' ,'ar') }}><img style="margin-right:8px"
                                src="{{ asset('img/uae2.png') }}">

                            Arabic</a>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item dropdown noti-dropdown me-2 dropdown-notifications">

            <a href="#" class="dropdown-toggle nav-link header-nav-list" data-bs-toggle="dropdown">
                <img src="{{ asset('assets/img/icons/header-icon-05.svg') }}" alt="">

                <span
                    class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow   notif-count"
                    data-count="{{ Auth()->user()->unreadNotifications->count() }}">{{ Auth()->user()->unreadNotifications->count() }}</span>
            </a>


            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header" id="notificationCount">
                    <span class="notification-title">@lang('pages.notifications')</span>
                    <a href="{{ route('notification_clear_all') }}" class="clear-noti">@lang('pages.clear_all') </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list" id="unreadNotifications">

                        @foreach (Auth()->user()->unreadNotifications as $notification)
                            <li class="notification-message">
                                <div class="media d-flex">

                                    @if ($notification->type === 'App\Notifications\RequestToJoin')
                                        @php
                                            $encodedIdLawyer = base64_encode($notification->data['user_id']);

                                        @endphp
                                        <div class="media-body flex-grow-1">
                                            <a> <span>@lang('pages.request_join_notification')</span></a>

                                            <a href="{{ route('show_lawyer', $encodedIdLawyer) }}">
                                                <p class="noti-details"> <span style="float: right;  font-size:12px;"
                                                        class="noti-title">{{ $notification->data['joined_user'] }}
                                                    </span>
                                                </p>

                                            </a>


                                            <p class="noti-time"><span
                                                    class="notification-time">{{ $notification->created_at?->format('j M Y') }}</span>
                                            </p>

                                        </div>

                                    @elseif ($notification->type === 'App\Notifications\SuggestionNotification')
                                        <div class="media-body flex-grow-1 ">
                                            <a>
                                                <p> @lang('pages.suggestion_title_notification') <span
                                                        class="noti-details">{{ $notification->data['title'] }}</span><br>
                                                    <span style="float: right;  font-size:12px;"> @lang('pages.person_suggestion_notification') <span
                                                            class="noti-details">{{ $notification->data['user_name'] }}</span>
                                                    </span>
                                                </p>
                                            </a>
                                            <p class="noti-time"><span
                                                    class="notification-time">{{ $notification->created_at?->format('j M Y') }}</span>
                                            </p>
                                        </div>
                                    @elseif ($notification->type === 'App\Notifications\ReplyRateNotification')
                                        @php
                                            $encodedIdQuestion = base64_encode($notification->data['question_id']);

                                        @endphp
                                        <div class="media-body flex-grow-1 row_notification">

                                            <p> @lang('pages.evaluted_question_notification')
                                                <span
                                                    class="details_notification">{{ $notification->data['client_name'] }}</span>
                                                <span>
                                                    <a href={{ route('show_general_question', $encodedIdQuestion) }}
                                                        class="link_notification">{{ $notification->data['question'] }}</span></a>

                                            </p>

                                            <p class="noti-time"><span
                                                    class="notification-time">{{ $notification->created_at?->format('j M Y') }}</span>
                                            </p>
                                        </div>
                                    @elseif ($notification->type === 'App\Notifications\ConsultationNotification')
                                        @php
                                            $encodedIdConsultation = base64_encode($notification->data['consultation_id']);
                                        @endphp
                                        <div class="media-body flex-grow-1 row_notification">

                                            <p> @lang('pages.sent_consultation_notification')
                                                <span
                                                    class="details_notification">{{ $notification->data['client_name'] }}</span>
                                                <span>
                                                    <a class="link_notification"
                                                        href="{{ route('show_consultation', $encodedIdConsultation) }}">
                                                        {{ $notification->data['consultation_title'] }}
                                                    </a>

                                                </span>
                                            </p>

                                            <p class="noti-time"><span
                                                    class="notification-time">{{ $notification->created_at?->format('j M Y') }}</span>
                                            </p>
                                        </div>
                                    @endif

                                </div>

                            </li>
                        @endforeach
                    </ul>
                </div>
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
                    <img class="rounded-circle" src="{{ Auth()->user()->getFirstMediaUrl('profileUser') }}"
                        width="31" alt="Soeng Souy">
                    <div class="user-text">
                        <h6>{{ Auth()->user()->name }}</h6>
                    </div>
                </span>
            </a>
            <div class="dropdown-menu">
                @role('lawyer|typingCenter|legalConsultant')
                    <a class="dropdown-item" href="{{ route('show_lawyer', $encodedId) }}">@lang('pages.profile')</a>
                @endrole

                @if (Auth::check())
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out" style="font-size:24px"></i> @lang('pages.logout')
                    </a>
                    <form method="POST" id="logout-form" action="{{ route('logout') }}">
                        @csrf
                    </form>
                @else
                    <a class="dropdown-item"
                        href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
                        <i class="me-50" data-feather="log-in"></i> @lang('pages.login')
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

                @role('lawyer|typingCenter|legalConsultant')
                    <li>
                        <a href="{{ route('dashboardLawyer') }}"><i class="feather-grid"></i>
                            <span> @lang('pages.dashboard')</span></a>
                    </li>
                    <li>
                        <a href="{{ route('list_consultations', $encodedId) }}"><i class="fas fa-balance-scale"></i>
                            <span> @lang('pages.consultation')</span></a>
                    </li>

                    <li>
                        <a href="{{ route('list_general_questions', $encodedId) }}"><i
                                class="far fa-question-circle"></i>
                            <span> @lang('pages.general_question')</span></a>
                    </li>
                @endrole
                @role('admin')
                    <li>
                        <a href="{{ route('dashboard') }}"><i class="feather-grid"></i>
                            <span> @lang('pages.dashboard')</span></a>
                    </li>

                    <li>
                        <a href="{{ route('list_practieces') }}"><i class="fas fa-gavel"></i>

                            </i>
                            <span>@lang('pages.practiece')</span> </a>
                    </li>

                    <li>
                        <a href="{{ route('list_lawyers') }}"><i class="fas fa-user-tie"></i>
                            <span> @lang('pages.lawyer') </span></a>
                    </li>

                    <li>
                        <a href="{{ route('list_clients') }}"><i class="fas fa-users"></i>
                            <span> @lang('pages.client') </span></a>
                    </li>

                    <li>
                        <a href="{{ route('list_consultations') }}"><i class="fas fa-balance-scale"></i>
                            <span> @lang('pages.consultation')</span></a>
                    </li>

                    <li>
                        <a href="{{ route('list_general_questions') }}"><i class="far fa-question-circle"></i>
                            <span>  @lang('pages.general_question')</span></a>
                    </li>

                    <li>
                        <a href="{{ route('list_join_us') }}"><i class="fas fa-user-plus"></i>
                            <span> @lang('pages.requests_to_join')</span></a>
                    </li>
                    <li>
                        <a href="{{ route('list_suggestion') }}"><i class="fas fa-lightbulb"></i>

                            <span> @lang('pages.suggestion') </span></a>
                    </li>
                @endrole

                <li>
                    <a href="{{ route('chat') }}"><i class="fas fa-comments"></i>

                        <span>@lang('pages.chat')</span>

                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
