@php
    $client_encoded_id = base64_encode(Auth()->user()->id);

@endphp

<header id="header">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top d-flex align-items-center  container">

        @role('lawyer')
            <a class="navbar-brand" href="{{ route('home_lawyer') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="logo__img img-fluid" />
                <br />
                <span class="logo__name">The legal platform</span>
            </a>
        @endrole

        @role('translation_company')
            <a class="navbar-brand" href="{{ route('home_company') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="logo__img img-fluid" />
                <br />
                <span class="logo__name">The legal platform</span>
            </a>
        @endrole
        @role('admin')
            <a class="navbar-brand" href="{{ route('home_client') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="logo" class="logo__img img-fluid" />
                <br />
                <span class="logo__name">The legal platform</span>
            </a>
        @endrole

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> @lang('pages.explore')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('explore_lawyer') }}">@lang('pages.lawyers')</a>
                        <a class="dropdown-item" href="{{ route('explore_translation_company') }}">
                            @lang('pages.companies')
                        </a>
                    </div>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('library') }}">
                        @lang('pages.library')
                    </a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-globe"></i>
                        @lang('pages.Language')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href={{ route('lang', 'en') }}>@lang('pages.english')</a>
                        <a class="dropdown-item" href={{ route('lang', 'ar') }}>@lang('pages.arabic')</a>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('about') }}">@lang('pages.about_as')</a>
                </li>

                @role('lawyer')
                    <li class="nav-item nav-box-header">
                        <a class="nav-link active" href="{{ route('lawyer_dashboard') }}">
                            <i class='bx bxs-dashboard icon-header'></i>
                        </a>
                    </li>
                @endrole

                @role('translation_company')
                    <li class="nav-item nav-box-header">
                        <a class="nav-link active" href="{{ route('company_dashboard') }}">
                            <i class='bx bxs-dashboard icon-header'></i>
                        </a>
                    </li>
                @endrole

                @role('admin')
                    <li class="nav-item nav-box-header">
                        <a class="nav-link active" href="{{ route('admin_dashboard') }}">
                            <i class='bx bxs-dashboard icon-header'></i>
                        </a>
                    </li>
                @endrole

                @role('lawyer|admin')
                    <li class="nav-item nav-box-header">
                        <a class="nav-link active" href="{{ route('chat_lawyer_dashboard') }}">
                            <i class="bx bx-chat icon-header"></i></a>
                    </li>
                @endrole

                @role('translation_company')
                    <li class="nav-item nav-box-header">
                        <a class="nav-link active" href="{{ route('chat_company_dashboard') }}">
                            <i class="bx bx-chat icon-header"></i></a>
                    </li>
                @endrole

                <li class="nav-item dropdown notification nav-box-header">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-bell icon-header"></i>
                        <span class="badge"
                            data-count="{{ Auth()->user()->unreadNotifications->count() }}">{{ Auth()->user()->unreadNotifications->count() }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right notification-list" aria-labelledby="navbarDropdown">

                        @foreach (Auth()->user()->unreadNotifications as $notification)
                            @if ($notification->type === 'App\Notifications\RequestToJoin')
                                <div class="media-body flex-grow-1 notification-item">
                                    <a class="notification-link" href="{{ route('request_to_join') }}">
                                        <span class="notification-title">
                                            @lang('pages.request_join_notification')
                                            {{ $notification->data['joined_user'] }}
                                        </span>
                                    </a>
                                    <span class="notification-time">
                                        {{ $notification->created_at?->format('j M Y') }}
                                    </span>
                                </div>
                            @elseif ($notification->type === 'App\Notifications\RefundConsultationNotification')
                                <div class="media-body flex-grow-1 notification-item">
                                    <a class="notification-link"
                                        href="{{ route('details_consultation', base64_encode($notification->data['consultation_id'])) }}">
                                        <span class="notification-title">
                                            @lang('pages.refund_consultation_notification') :
                                            {{ $notification->data['title'] }}
                                        </span>
                                    </a>
                                    <span class="notification-time">
                                        {{ $notification->created_at?->format('j M Y') }}
                                    </span>
                                </div>
                            @elseif ($notification->type === 'App\Notifications\RejectCaseNotification')
                                <div class="media-body flex-grow-1 notification-item">
                                    <p class="notification-title">
                                        @lang('pages.reject_case_notification')
                                        <span class="details_notification">
                                            {{ $notification->data['client_name'] }} :
                                        </span>

                                        <span>
                                            <a class="notification-link"
                                                href="{{ route('show_case', base64_encode($notification->data['case_id'])) }}">
                                                <span class="notification-title">
                                                    {{ $notification->data['case_title'] }}
                                                </span>
                                            </a>
                                        </span>
                                    </p>
                                    <span class="notification-time">
                                        {{ $notification->created_at?->format('j M Y') }}
                                    </span>
                                </div>
                            @elseif ($notification->type === 'App\Notifications\AcceptCaseNotification')
                                <div class="media-body flex-grow-1 notification-item">
                                    <p class="notification-title">
                                        @lang('pages.accept_case_notification')
                                        <span class="details_notification">
                                            {{ $notification->data['client_name'] }} :
                                        </span>
                                        <span>
                                            <a class="notification-link"
                                                href="{{ route('show_case', base64_encode($notification->data['case_id'])) }}">
                                                <span class="notification-title">
                                                    {{ $notification->data['case_title'] }}
                                                </span>
                                            </a>
                                        </span>
                                    </p>
                                    <span class="notification-time">
                                        {{ $notification->created_at?->format('j M Y') }}
                                    </span>
                                </div>
                            @elseif ($notification->type === 'App\Notifications\ConsultationNotification')
                                <div class="media-body flex-grow-1 notification-item">
                                    <p class="notification-title">
                                        @lang('pages.sent_consultation_notification')

                                        <span class="details_notification">
                                            {{ $notification->data['client_name'] }} :
                                        </span>

                                        <span>
                                            <a class="notification-link"
                                                href="{{ route('details_consultation', base64_encode($notification->data['consultation_id'])) }}">
                                                <span class="notification-title">
                                                    {{ $notification->data['consultation_title'] }}
                                                </span>
                                            </a>
                                        </span>
                                    </p>

                                    <span class="notification-time">
                                        {{ $notification->created_at?->format('j M Y') }}
                                    </span>
                                </div>
                            @elseif ($notification->type === 'App\Notifications\ClosedConsultationAdminNotification')
                                <div class="media-body flex-grow-1 notification-item">
                                    <p class="notification-title">
                                        @lang('pages.closed_consultation_notification')
                                        <span>
                                            <a class="notification-link"
                                                href="{{ route('details_consultation', $notification->data['consultation_encode_id']) }}">
                                                <span class="notification-title">
                                                    {{ $notification->data['consultation_title'] }}
                                                </span>
                                            </a>
                                        </span>
                                    </p>
                                    <span class="notification-time">
                                        {{ $notification->data['created_at'] }}
                                    </span>
                                </div>
                            @elseif($notification->type === 'App\Notifications\ClosedCaseAdminNotification')
                                <div class="media-body flex-grow-1 notification-item">
                                    <p class="notification-title">
                                        @lang('pages.closed_case_notification')
                                        <span>
                                            <a class="notification-link"
                                                href="{{ route('show_case', $notification->data['case_encode_id']) }}">
                                                <span class="notification-title">
                                                    {{ $notification->data['case_title'] }}
                                                </span>
                                            </a>
                                        </span>
                                    </p>
                                    <span class="notification-time">{{ $notification->data['created_at'] }} </span>
                                </div>
                            @elseif($notification->type === 'App\Notifications\ClosedRequestAdminNotification')
                                <div class="media-body flex-grow-1 notification-item">
                                    <p class="notification-title">
                                        @lang('pages.closed_request_notification')
                                        <span>
                                            <a class="notification-link"
                                                href="{{ route('show_requests', $notification->data['request_encode_id']) }}">
                                                <span class="notification-title">
                                                    {{ $notification->data['request_title'] }}
                                                </span>
                                            </a>
                                        </span>
                                    </p>
                                    <span class="notification-time">{{ $notification->data['created_at'] }} </span>
                                </div>
                            @elseif($notification->type === 'App\Notifications\RequestNotification')
                                <div class="media-body flex-grow-1 notification-item">
                                    <p class="notification-title">
                                        @lang('pages.sent_request_notification')
                                        <span class="details_notification">
                                            {{ $notification->data['client_name'] }} :
                                        </span>

                                        <span>
                                            <a class="notification-link"
                                                href="{{ route('show_requests', base64_encode($notification->data['document_id'])) }}">
                                                <span class="notification-title">
                                                    {{ $notification->data['document_title'] }}
                                                </span>
                                            </a>
                                        </span>
                                    </p>
                                    <span class="notification-time">
                                        {{ $notification->created_at?->format('j M Y') }}
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
            <a href="#"> <img class="img-profile" src="{{ Auth()->user()->getFirstMediaUrl('profile') }}"
                    alt="" /></a>
            </ul>
        </div>
    </nav>
    <script>
        var translatedSendCase = "{{ __('pages.sent_case_notification') }}";
        var translatedClosedCase = "{{ __('pages.closed_case_notification') }}";
        var translatedRejectCase = "{{ __('pages.reject_case_notification') }}";
        var translatedAcceptCase = "{{ __('pages.accept_case_notification') }}";

        var translatedClosedConsultation = "{{ __('pages.closed_consultation_notification') }}";
        var translatedRefundConsultation = "{{ __('pages.refund_consultation_notification') }}";
        var translatedSendConsultation = "{{ __('pages.sent_consultation_notification') }}";

        var translatedClosedRequest = "{{ __('pages.closed_request_notification') }}";
        var translatedSendRequest = "{{ __('pages.sent_request_notification') }}";

        var translatedRequestToJoin = "{{ __('pages.request_to_join') }}";

    </script>
</header>
