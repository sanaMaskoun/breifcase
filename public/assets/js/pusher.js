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


var notificationsWrapper = $('.nav-item.dropdown.notification');
var notificationsToggle = notificationsWrapper.find('a.nav-link.dropdown-toggle');
var notificationsCountElem = notificationsToggle.find('span.badge');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = notificationsWrapper.find('div.notification-list');

var channelConsultation = pusherPrivate.subscribe('private-consultation-channel-' + localStorage.getItem('user_id'));
var channelCase = pusherPrivate.subscribe('private-case-channel-' + localStorage.getItem('user_id'));
var channelAcceptCase = pusherPrivate.subscribe('private-acceppt-channel-' + localStorage.getItem('user_id'));
var channelRejectCase = pusherPrivate.subscribe('private-reject-channel-' + localStorage.getItem('user_id'));
var channelClosedConsultation = pusherPrivate.subscribe('private-closed-consultation-client-channel-' + localStorage.getItem('user_id'));

var channelClosedCase = pusherPrivate.subscribe('private-closed-case-client-channel-' + localStorage.getItem('user_id'));
var channelClosedRequest = pusherPrivate.subscribe('closed-request-client-channel-' + localStorage.getItem('user_id'));


channelClosedConsultation.bind('closedConsultationClient', function(data) {
    var newClosedConsultation = `
   <li class="notification-message">
        <div class="media d-flex">
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
        </div>
    </li>
    `;

    notifications.prepend(newClosedConsultation);
    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);

    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});

channelClosedRequest.bind('closedRequestClient', function(data) {
    var newClosedRequest = `
   <li class="notification-message">
        <div class="media d-flex">
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
        </div>
    </li>
    `;

    notifications.prepend(newClosedRequest);
    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);

    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});


channelClosedCase.bind('closedCaseClient', function(data) {
    var newClosedCase = `
    <li class="notification-message">
        <div class="media d-flex">
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
        </div>
    </li>
    `;

    notifications.prepend(newClosedCase);
    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);

    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});


channelConsultation.bind('App\\Events\\ConsultationEvent', function(data) {
    var newConsultation = `
    <li class="notification-message">
        <div class="media d-flex">
            <div class="media-body flex-grow-1 notification-item">
                <p class="notification-title">A consultation has been sent by
                    <span class="details_notification">${data.client_name} :</span>
                    <span>
                        <a class="notification-link" href="/consultation/${data.consultation_encoded_id}/details">
                            <span class="notification-title">${data.consultation_title}</span>
                        </a>
                    </span>
                </p>
                <span class="notification-time">${new Date().toLocaleDateString('en-GB', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                })}</span>
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

channelCase.bind('App\\Events\\CaseEvent', function(data) {
    var newCase = `
    <li class="notification-message">
        <div class="media d-flex">
            <div class="media-body flex-grow-1 notification-item">
                <p class="notification-title">A case has been sent by
                    <span class="details_notification">${data.lawyer_name} :</span>
                    <span>
                        <a class="notification-link" href="/case/${data.case_encoded_id}/details">
                            <span class="notification-title">${data.case_title}</span>
                        </a>
                    </span>
                </p>
                <span class="notification-time">${new Date().toLocaleDateString('en-GB', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                })}</span>
            </div>
        </div>
    </li>
    `;

    notifications.prepend(newCase);
    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);

    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});


channelAcceptCase.bind('App\\Events\\AcceptCaseEvent', function(data) {
    var newAcceptCase = `
    <li class="notification-message">
        <div class="media d-flex">
            <div class="media-body flex-grow-1 notification-item">
                <p class="notification-title">The case has been accepted by
                    <span class="details_notification">${data.client_name} :</span>
                    <span>
                        <a class="notification-link" href="/case/${data.case_encoded_id}/show">
                            <span class="notification-title">${data.case_title}</span>
                        </a>
                    </span>
                </p>
                <span class="notification-time">${new Date().toLocaleDateString('en-GB', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                })}</span>
            </div>
        </div>
    </li>
    `;

    notifications.prepend(newAcceptCase);
    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);

    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});


channelRejectCase.bind('App\\Events\\RejectCaseEvent', function(data) {
    var newRejectCase = `
    <li class="notification-message">
        <div class="media d-flex">
            <div class="media-body flex-grow-1 notification-item">
                <p class="notification-title">The case was rejected by
                    <span class="details_notification">${data.client_name} :</span>
                    <span>
                        <a class="notification-link" href="/case/${data.case_encoded_id}/show">
                            <span class="notification-title">${data.case_title}</span>
                        </a>
                    </span>
                </p>
                <span class="notification-time">${new Date().toLocaleDateString('en-GB', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                })}</span>
            </div>
        </div>
    </li>
    `;

    notifications.prepend(newRejectCase);
    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);

    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});




//new chat
var channelPivateNewChat = pusherPrivate.subscribe('private-new-chat-channel-' + localStorage.getItem('user_id'));
channelPivateNewChat.bind('newChatMessage', function (data) {

    let newChat = ` <a href="/chat/dashboard/${data.sender_encoded_id}" class="list-group-item1"
                                onclick="openChat('Jamie Chastain')">
                                <div class="contact-info">
                                    <img src="${data.sender_profile}""  alt="User Image">
                                    <div>
                                        <div class="user-name">${data.sender_name}</div>
                                        <div class="last-message  last_msg_form_chat" >
                                            ${data.message}</div>
                                        <div class="last-seen"> ${data.created_at}
                                        </div>
                                    </div>
                                </div>
                                <span class="badge-2"> 1 </span>
                            </a>`

        $("#new_chat_div").append(newChat);

});

//chat
var channelPivateChat = pusherPrivate.subscribe('private-chat-channel-' + localStorage.getItem('user_id'));
channelPivateChat.bind('chatMessage', function (data) {
    var extension = data.attachment ? data.attachment.extension.toLowerCase() : null;
    message = "";
    let receiverMessage = `
    <div class="media media-chat" id="chat_area_receiver">
        <div class="media-body">
            <div class="text-content">
                ${data.attachment ?
            (extension === 'jpg' || extension === 'png' ?
                `<img class="img_group clickable" src="${data.attachment.url}">
                 <span class="message">${data.message}</span>` :
                `<a href="${data.attachment.url}" target="_blank"><p class="message">${data.message}</p></a>`) :
            `<p class="message">${data.message}</p>`}
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
                `<img class="img_group clickable" src="${data.attachment.url}">
                 <span class="message">${data.message}</span>` :
                `<a href="${data.attachment.url}" target="_blank"><p class="message">${data.message}</p></a>`) :
            `<p class="message">${data.message}</p>`}
                <time class="time">${data.created_at}</time>
            </div>
        </div>
    </div>`;

    if (data.sender_id === localStorage.getItem('user_id')) {
        message = senderMessage;
    } else if (data.receiver_id === localStorage.getItem('user_id')) {
        message = receiverMessage;
    }

    if (message != "") {
        $('.empty-messages').remove();
    }
    $("#chat_div").append(message);

     const newImages = document.querySelectorAll(".img_group.clickable");
     newImages.forEach(addModalFunctionality);
});


//counter chat
var channelPrivateCounterChat = pusherPrivate.subscribe('private-counter-chat-channel-' + localStorage.getItem('user_id'));
channelPrivateCounterChat.bind('counterChat', function (data) {

    var userId = localStorage.getItem('user_id');

    var isSender = (data.sender_id == userId);
    if (data.receiver_id == userId) {
        var lastMessage = data.message;
        $('#last_message_' + data.sender_id).text(lastMessage);

        var counterElement = $('#counter_chat_' + data.sender_id);

        var counterText = counterElement.text().trim();
        if (counterText !== '') {
            var count = parseInt(counterText);
            count++;
            counterElement.text(count.toString());
        } else {
            counterElement.text('1');
        }
    } else if (isSender) {
        var lastMessage = data.message;
        $('#last_message_' + data.receiver_id).text(lastMessage);
    }
});

//counter chat in group
var channelPrivateCounterChatGroup = pusherPrivate.subscribe('private-counter-chat-group-channel-'+localStorage.getItem('user_id'));
channelPrivateCounterChatGroup.bind('counterChatGroup', function (data) {

    var userId = localStorage.getItem('user_id');
      if (data.member_id == userId) {

    var counterElement = $('#counter_chat_group_' + data.group_id);

    var counterText = counterElement.text().trim();
    if (counterText !== '') {
        var count = parseInt(counterText);
        count++;
        counterElement.text(count.toString());
    } else {
        counterElement.text('1');
    }
     }
});
