<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>breifcase</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.jpeg') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>


<body>
    <div class="main-wrapper">

        @include('master.header')

        @yield('content')
    </div>

    <input type="hidden" id="projectUrl" value="{{ url('/') }}"></div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        localStorage.setItem('user_id', {{ Auth()->user()->id }})
    </script>
    {{--  <script src="https://breifcase.briefcaseplatform.com/assets/js/pusher.js"></script>  --}}

    <script src="{{ url('/assets/js/pusher.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


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


    @yield('scripts')
</body>

</html>
