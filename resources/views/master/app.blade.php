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
    <link rel="stylesheet" href="{{ asset('assets/css/AdminStyes.css') }}" />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
            @elseif (Auth::user()->type == UserTypeEnum::lawyer ||
                    Auth::user()->type == UserTypeEnum::translation_company ||
                    Auth::user()->type == UserTypeEnum::admin)
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

                var notificationsWrapper = $('.nav-item.dropdown.notification');
                var notificationsToggle = notificationsWrapper.find('a.nav-link.dropdown-toggle');
                var notificationsCountElem = notificationsToggle.find('span.badge');
                var notificationsCount = parseInt(notificationsCountElem.data('count'));
                var notifications = notificationsWrapper.find('div.notification-list');

                function formatDate(date) {
                    const options = {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    };
                    return new Intl.DateTimeFormat('en-GB', options).format(date);
                }


                var channelNotification = pusherPrivate.subscribe('private-notify-channel');
                var channelRefundConsultation = pusherPrivate.subscribe('private-refund-consultation-channel');
                var channelClosedCase = pusherPrivate.subscribe('private-closed-case-admin-channel');
                var channelClosedConsultation = pusherPrivate.subscribe('private-closed-consultation-admin-channel');
                var channelClosedRequest = pusherPrivate.subscribe('private-closed-request-admin-channel');


                $(document).ready(function() {

                    channelNotification.bind('App\\Events\\NotificationEvent', function(data) {
                        var newNotificationHtml = `
                            <div class="media-body flex-grow-1 notification-item">
                                <a class="notification-link" href="/request-to-join">
                                    <span class="notification-title">these user request to join: ${data.user_name}</span>
                                </a>
                                <span class="notification-time">${data.date}</span>
                            </div>
                        `;
                        notifications.prepend(newNotificationHtml);
                        notificationsCount += 1;
                        notificationsCountElem.text(notificationsCount);
                        notificationsCountElem.data('count', notificationsCount);

                        notificationsWrapper.show();
                    });
                });

                channelClosedRequest.bind('closedRequestAdmin', function(data) {
                    var newClosedRequest = `

                            <div class="media-body flex-grow-1 notification-item">
                                  <p class="notification-title">This request has been closed
                                      <span>
                                          <a class="notification-link"
                                              href="/document/request/${data.request_encode_id}/show">
                                               <span class="notification-title">
                                                   ${data.request_title}</span>
                                           </a>
                                     </span>
                                </p>
                                <span class="notification-time">${data.created_at} </span>
                             </div>

                    `;

                    notifications.prepend(newClosedRequest);
                    notificationsCount += 1;
                    notificationsCountElem.text(notificationsCount);

                    notificationsWrapper.find('.notif-count').text(notificationsCount);
                    notificationsWrapper.show();
                });

                channelClosedConsultation.bind('closedConsultationAdmin', function(data) {
                    var newClosedConsultation = `

                            <div class="media-body flex-grow-1 notification-item">
                                  <p class="notification-title">This consultation has been closed
                                      <span>
                                          <a class="notification-link"
                                              href="/consultation/${data.consultation_encode_id}/details">
                                               <span class="notification-title">
                                                   ${data.consultation_title}</span>
                                           </a>
                                     </span>
                                </p>
                                <span class="notification-time">${data.created_at} </span>
                             </div>

                    `;

                    notifications.prepend(newClosedConsultation);
                    notificationsCount += 1;
                    notificationsCountElem.text(notificationsCount);

                    notificationsWrapper.find('.notif-count').text(notificationsCount);
                    notificationsWrapper.show();
                });


                channelClosedCase.bind('closedCaseAdmin', function(data) {
                    var newClosedCase = `

                            <div class="media-body flex-grow-1 notification-item">
                                  <p class="notification-title">This case has been closed
                                      <span>
                                          <a class="notification-link"
                                              href="/case/${data.case_encode_id}/show">
                                               <span class="notification-title">
                                                   ${data.case_title}</span>
                                           </a>
                                     </span>
                                </p>
                                <span class="notification-time">${data.created_at} </span>
                             </div>

                    `;

                    notifications.prepend(newClosedCase);
                    notificationsCount += 1;
                    notificationsCountElem.text(notificationsCount);

                    notificationsWrapper.find('.notif-count').text(notificationsCount);
                    notificationsWrapper.show();
                });


                channelRefundConsultation.bind('App\\Events\\RefundConsultationEvent', function(data) {
                    const now = new Date();
                    const formattedDate = formatDate(now);
                    var newRefundConsultationHtml = `
                        <div class="media-body flex-grow-1 notification-item">
                            <a class="notification-link" href="/consultation/${data.consultation_encoded_id}/details">
                                <span class="notification-title">This consultation has not been responded to. Return the amount to the customer: ${data.title}</span>
                            </a>
                         <span class="notification-time">${formattedDate}</span>
                        </div>
                    `;

                    notifications.prepend(newRefundConsultationHtml);
                    notificationsCount += 1;
                    notificationsCountElem.text(notificationsCount);

                    notificationsWrapper.find('.badge').text(notificationsCount);
                    notificationsWrapper.show();
                });

            </script>
        @endif
    @endif

    @yield('scripts')


    <script src="{{ asset('assets/js/searchLawyer.js') }}"></script>
    <script src="{{ asset('assets/js/searchStatusDocument.js') }}"></script>
    <script src="{{ asset('assets/js/searchClient.js') }}"></script>
    <script src="{{ asset('assets/js/searchCompany.js') }}"></script>
    <script src="{{ asset('assets/js/searchInvoice.js') }}"></script>
    <script src="{{ asset('assets/js/searchContact.js') }}"></script>
    <script src="{{ asset('assets/js/searchExplore.js') }}"></script>
    <script src="{{ asset('assets/js/searchLibrary.js') }}"></script>
    <script src="{{ asset('assets/js/rating.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/tab.js') }}"></script>
    <script src="{{ asset('assets/js/img.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/oldScript.js') }}"></script>
    <script src="{{ asset('assets/js/file.js') }}"></script>
    <script src="{{ asset('assets/js/chartAdmin.js') }}"></script>
    <script src="{{ asset('assets/js/chartCompany.js') }}"></script>
    <script src="{{ asset('assets/js/chartLawyer.js') }}"></script>
    <script src="{{ asset('assets/js/doughnutChart.js') }}"></script>
    <script src="{{ asset('assets/js/img-join-lawyer.js') }}"></script>
    <script src="{{ asset('assets/js/membersGroup.js') }}"></script>


</body>

</html>
