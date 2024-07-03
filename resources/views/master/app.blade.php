<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/ClientStyles.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/LawyerStyles.css') }}" />
    <title>Briefcase - The Legal Platform</title>
    <style>
        :root {
            --background-url: url('{{ asset('assets/img/screen.webp') }}');
            --logo-url: url('{{ asset('img/user_icon.png') }}');
        }
    </style>
</head>


<body class="en ar">
    @php
        use App\Enums\UserTypeEnum;
    @endphp
    <div class="main-wrapper">
        @if (Auth()->user() != null && Auth()->user()->is_active == true)
            @if (Auth::user()->type == UserTypeEnum::client)
                @include('master.header_auth_client')
            @elseif (Auth::user()->type == UserTypeEnum::lawyer ||  Auth::user()->type == UserTypeEnum::translation_company )
                @include('master.header_auth_lawyer')
            @endif
        @else
            @include('master.header')
        @endif

        @yield('content')

        @if (Auth()->user() != null && Auth()->user()->is_active == true)
            @include('master.footer')
        @endif
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    {{--  pusher  --}}
    <input type="hidden" id="projectUrl" value="{{ url('/') }}"></div>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script src="{{ url('/assets/js/pusher.js') }}"></script>
    {{--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  --}}

    @if (Auth()->user()?->id != null)
        <script>
            localStorage.setItem('user_id', {{ Auth()->user()->id }})
        </script>


        @if (Auth()->user()->roles->pluck('name')->first() == 'admin')
            <script>
                var pusherPrivate = new Pusher('21c93d7ae9ded5a63591', {
                    broadcast: 'pusher',
                    cluster: 'ap2',
                    authEndpoint: projectUrl + "/api/pusher/auth",
                    auth: {
                        headers: {
                            // 'X-CSRF-Token': "12365",
                            // "Authorization": "Bearer 354681",
                            // "Access-Control-Allow-Origin": "*",
                            // 'Accept': 'application/json',
                        }
                    }
                });
                var notificationsWrapper = $('.dropdown-notifications');
                var notificationsToggle = notificationsWrapper.find('a[data-bs-toggle]');
                var notificationsCountElem = notificationsToggle.find('span[data-count]');
                var notificationsCount = parseInt(notificationsCountElem.data('count'));
                var notifications = notificationsWrapper.find('ul.notification-list');

                var channelNotification = pusherPrivate.subscribe('private-notify-channel');
                var channelSuggestion = pusherPrivate.subscribe('private-suggestion-channel');
                var channelRefundConsultation = pusherPrivate.subscribe('private-refund-consultation-channel');

                channelRefundConsultation.bind('App\\Events\\RefundConsultationEvent', function(data) {
                    var newRefundConsultationHtml = `
                    <li class="notification-message">
                        <div class="media d-flex">

                            <div class="media-body flex-grow-1">
                                <p> This consultation has not been responded to. Return the amount to the customer
                                    <span>
                                            <a class="link_notification" href="/consultation/${data.encodedId}/show">
                                            ${data.title}
                                            </a>

                                        </span>
                                    </p>
                            </div>
                        </div>
                    </li>
                `;
                    notifications.prepend(newRefundConsultationHtml);
                    notificationsCount += 1;
                    notificationsCountElem.text(notificationsCount);

                    notificationsWrapper.find('.notif-count').text(notificationsCount);
                    notificationsWrapper.show();
                });

                channelNotification.bind('App\\Events\\NotificationEvent', function(data) {
                    var newNotificationHtml = `
                    <li class="notification-message">
                        <div class="media d-flex">
                            <div class="media-body flex-grow-1">
                        <a>  <span>these user request to join :</span></a>
                            <a href="${data.encodedId}">
                            <p class="noti-details"> <span style="float: right;  font-size:12px;"
                            class="noti-title">${data.user_name} </span>
                            </p>

                        </a>
                                <p class="noti-time"><span class="notification-time">${data.date}</span></p>
                            </div>
                        </div>
                    </li>
                `;
                    notifications.prepend(newNotificationHtml);
                    notificationsCount += 1;
                    notificationsCountElem.text(notificationsCount);

                    notificationsWrapper.find('.notif-count').text(notificationsCount);
                    notificationsWrapper.show();
                });

                channelSuggestion.bind('App\\Events\\SuggestionEvent', function(data) {
                    var newSuggestionHtml = `
                    <li class="notification-message">
                        <div class="media d-flex">

                            <div class="media-body flex-grow-1">
                            <a>
                            <p> suggestion title: <span
                                    class="noti-details"> ${data.title}</span><br>
                                    <span style="float: right;  font-size:12px;"> By : <span
                                            class="noti-details">${data.user_name}</span>
                                            </span>
                                        </p>
                                    </a>
                                <p class="noti-time"><span class="notification-time">${data.date}</span></p>
                            </div>
                        </div>
                    </li>
                `;
                    notifications.prepend(newSuggestionHtml);
                    notificationsCount += 1;
                    notificationsCountElem.text(notificationsCount);

                    notificationsWrapper.find('.notif-count').text(notificationsCount);
                    notificationsWrapper.show();
                });
            </script>
        @endif
    @endif

    @yield('scripts')


    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/tab.js') }}"></script>
    <script src="{{ asset('assets/js/img.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/oldScript.js') }}"></script>
    <script src="{{ asset('assets/js/file.js') }}"></script>
    <script src="{{ asset('assets/js/dash-1.js') }}"></script>
    <script src="{{ asset('assets/js/dash.js') }}"></script>
    <script src="{{ asset('assets/js/img-join-lawyer.js') }}"></script>
</body>

</html>
