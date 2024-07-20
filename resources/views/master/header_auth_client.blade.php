@php
    $client_encoded_id = base64_encode(Auth()->user()->id);

@endphp
<header id="header">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top d-flex align-items-center my-5 container">

        <a class="navbar-brand" href="{{ route('home_client') }}">
            <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="logo__img img-fluid" />
            <br />
            <span class="logo__name">The legal platform</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Explore
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('explore_lawyer') }}">Lawyer</a>
                        <a class="dropdown-item" href="{{ route('explore_translation_company') }}">Translation
                            Company</a>
                    </div>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('library') }}">Library</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-globe"></i> Language
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">English</a>
                        <a class="dropdown-item" href="#">Arabic</a>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link active " href="{{ route('about') }}">About Us</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('chat_client') }}">
                        <i class="bx bx-chat icon-header"></i></a>
                </li>

                <li class="nav-item dropdown notification">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-bell icon-header"></i>
                        <span class="badge"
                            data-count="{{ Auth()->user()->unreadNotifications->count() }}">{{ Auth()->user()->unreadNotifications->count() }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right notification-list" aria-labelledby="navbarDropdown">

                        @foreach (Auth()->user()->unreadNotifications as $notification)
                            @if ($notification->type === 'App\Notifications\CaseNotification')
                                <div class="media-body flex-grow-1 notification-item">
                                    <p class="notification-title"> @lang('pages.sent_case_notification')
                                        <span class="details_notification">{{ $notification->data['lawyer_name'] }}
                                            :</span>
                                        <span>
                                            <a class="notification-link"
                                                href="{{ route('details_case', base64_encode($notification->data['case_id'])) }}">
                                                <span class="notification-title">
                                                    {{ $notification->data['case_title'] }}</span>
                                            </a>
                                        </span>
                                    </p>
                                    <span class="notification-time">{{ $notification->created_at?->format('j M Y') }}
                                    </span>
                                </div>
                            @endif
                        @endforeach

                        <div class="topnav-dropdown-header d-flex justify-content-end" id="notificationCount">
                            <a href="{{ route('notification_clear_all') }}"
                                class="notification-clear">@lang('pages.clear_all')</a>
                        </div>
                    </div>
                </li>
            </ul>

            <a href="{{ route('show_client', $client_encoded_id) }}"> <img class="img-profile"
                    src="{{ asset('assets/img/Full_Website_-_LAWYER_V1__5_-removebg-preview.png') }}"
                    alt="" /></a>
            </ul>
        </div>
    </nav>
</header>
