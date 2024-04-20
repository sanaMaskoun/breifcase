Pusher.logToConsole = true;

var pusher = new Pusher('21c93d7ae9ded5a63591', {
    cluster: 'ap2'
});

var notificationsWrapper = $('.dropdown-notifications');
var notificationsToggle = notificationsWrapper.find('a[data-bs-toggle]');
var notificationsCountElem = notificationsToggle.find('span[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = notificationsWrapper.find('ul.notification-list');


var channelNotification = pusher.subscribe('notify-channel');
var channelSuggestion = pusher.subscribe('suggestion-channel');
var channelConsultation = pusher.subscribe('consultation-channel.' + localStorage.getItem('user_id'));
var channelReplayRate = pusher.subscribe('rate-channel');

channelNotification.bind('App\\Events\\NotificationEvent', function (data) {
    var newNotificationHtml = `
    <li class="notification-message">
        <div class="media d-flex">
            <div class="media-body flex-grow-1">
           <a>  <span>these user request to join :</span></a>
            <a href="${data.user_id}">
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

channelSuggestion.bind('App\\Events\\SuggestionEvent', function (data) {
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

channelConsultation.bind('App\\Events\\ConsultationEvent', function (data) {console.log(1);
    var newConsultation = `
    <li class="notification-message">
     <div class="media d-flex">

        <div class="media-body flex-grow-1 row_notification">
                <p> A consultation has been sent by :
                <span class="details_notification">${data.client_name}</span>
                <span>
                        <a class="link_notification" href="/consultation/${data.consultation_id}/show">
                        ${data.consultation_title}
                        </a>

                    </span>
                </p>

                <p class="noti-time"><span class="notification-time">${data.date}</span></p>

        </div>
     </div>
    </li>
`;
    notifications.prepend(newConsultation);
    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);

    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});

channelReplayRate.bind('App\\Events\\ReplyRateEvent', function (data) {
    var newReplyRateHtml = `
    <li class="notification-message">
    <div class="media d-flex">

       <div class="media-body flex-grow-1 row_notification">
       <p> Your reply to the  general question has been evaluated by :
       <span class="details_notification">${data.client_name}</span>
               <span>
               <a class="link_notification" href="/general_question/${data.question_id}/show">
               ${data.question}
                       </a>

                   </span>
               </p>

               <p class="noti-time"><span class="notification-time">${data.date}</span></p>

       </div>
    </div>
   </li>
`;

    notifications.prepend(newReplyRateHtml);
    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);

    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});
