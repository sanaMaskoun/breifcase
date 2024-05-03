Pusher.logToConsole = true;

var pusher = new Pusher('21c93d7ae9ded5a63591', {
    cluster: 'ap2'
});
projectUrl = $('#projectUrl').val();
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


var channelNotification = pusherPrivate.subscribe('private-notify-channel-' + localStorage.getItem('user_id'));
var channelSuggestion = pusherPrivate.subscribe('private-suggestion-channel-' + localStorage.getItem('user_id'));
var channelConsultation = pusherPrivate.subscribe('private-consultation-channel-' + localStorage.getItem('user_id'));
var channelReplayRate = pusherPrivate.subscribe('private-rate-channel-' + localStorage.getItem('user_id'));

channelNotification.bind('App\\Events\\NotificationEvent', function (data) {
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

channelConsultation.bind('App\\Events\\ConsultationEvent', function (data) {
    var newConsultation = `
    <li class="notification-message">
     <div class="media d-flex">

        <div class="media-body flex-grow-1 row_notification">
                <p> A consultation has been sent by :
                <span class="details_notification">${data.client_name}</span>
                <span>
                        <a class="link_notification" href="/consultation/${data.encodedId}/show">
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
               <a class="link_notification" href="/general_question/${data.encodedId}/show">
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


//chat  private-chat-channel


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

var channelPivateChat = pusherPrivate.subscribe('private-chat-channel');
channelPivateChat.bind('chatMessage', function (data) {
    console.log(data);
    var extension = data.attachment ? data.attachment.split('.').pop().toLowerCase() : null;
    message = "";
    let receiverMessage = `
    <div class="media media-chat" id="chat_area_receiver">
        <div class="media-body">
            <div class="text-content">
                ${data.attachment ?
            (extension === 'jpg' || extension === 'png' ?
                `<img class="img_group" src="${data.attachment}">` :
                `<a href="${data.attachment}" target="_blank"><p class="message">${data.message}</p></a>`) :
            `<p class="message">${data.message} </p>`}
                <time class="time">${data.created_at}</time>
            </div>
        </div>
    </div>`;

    let senderMessage = `
    <div class="media media-chat media-chat-right" id="chat_area_sender">
        <div class="media-body">
            <div class="text-content">
                ${data.attachment ?
            (extension === 'jpg' || extension === 'png' ?
                `<img class="img_group" src="${data.attachment}">` :
                `<a href="${data.attachment}" target="_blank"><p class="message">${data.message}</p></a>`) :
            `<p class="message">${data.message} </p>`}
                <time class="time">${data.created_at}</time>
            </div>
        </div>
    </div>`;


    if (data.sender_id == localStorage.getItem('user_id')) {

        message = senderMessage;
    }
    else if (data.receiver.id == localStorage.getItem('user_id')) {
        message = receiverMessage;
    }

    if (message != "") {
        $('.empty-messages').remove();
    }
    $("#chat_div").append(message);

});


//chat group
var channelChat = pusher.subscribe('group-channel');
channelChat.bind('groupMessage', function (data) {
    var extension = data.attachment ? data.attachment.split('.').pop().toLowerCase() : null;
    message_group = "";

    let receiverMessage = `
    <div class="media media-chat" id="group_area_receiver">
        <div class="media-body img-groups">
        <a href="/lawyer/${data.sender_id_encoded}/show">
        <img class="rounded-circle img_group" src="${data.sender_profile}">
        <span>${data.sender_name}</span>
        </a>
            <div class="text-content">
                ${data.attachment ?
            (extension === 'jpg' || extension === 'png' ?
                `<img class="img_group" src="${data.attachment}">` :
                `<a href="${data.attachment}" target="_blank"><p class="message">${data.message}</p></a>`) :
            `<p class="message">${data.message} </p>`}
                <time class="time">${data.created_at}</time>
            </div>
        </div>
    </div>`;

    let senderMessage = `
    <div class="media media-chat media-chat-right" id="group_area_sender">
    <div class="media-body">
    <div class="text-content">
    ${data.attachment ?
            (extension === 'jpg' || extension === 'png' ?
                `<img class="img_group" src="${data.attachment}">` :
                `<a href="${data.attachment}" target="_blank"><p class="message">${data.message}</p></a>`) :
            `<p class="message">${data.message} </p>`}
    <time class="time">${data.created_at}</time>
</div>
    <a href="/lawyer/${data.sender_id_encoded}/show">
    <img class="rounded-circle img_group" src="${data.sender_profile}">
    </a>

    </div>
    </div>`;

    if (data.sender_id == localStorage.getItem('user_id')) {
        message_group = senderMessage;
    }
    else {
        message_group = receiverMessage;
    }
    if (message_group != "") {
        $('.empty-messages').remove();
    }


    $("#group_div").append(message_group);


});


