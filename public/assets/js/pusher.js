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
var channelClosedRequest = pusherPrivate.subscribe('private-closed-request-client-channel-' + localStorage.getItem('user_id'));
var channelRequest = pusherPrivate.subscribe('private-request-channel-' + localStorage.getItem('user_id'));



//chat
var channelPivateChat = pusherPrivate.subscribe('private-chat-channel-' + localStorage.getItem('user_id'));
channelPivateChat.bind('chatMessage', function (data) {
        var chatDiv = document.getElementById('chat_div');
        var isSender = data.sender_id === localStorage.getItem('user_id');

        var messageDiv = document.createElement('div');
        messageDiv.classList.add('media', 'media-chat');
        if (isSender) {
            messageDiv.classList.add('media-chat-right');
        }

        var messageBodyDiv = document.createElement('div');
        messageBodyDiv.classList.add('media-body');

        var textContentDiv = document.createElement('div');
        textContentDiv.classList.add('text-content');

        if (data.attachment) {
            var extension = data.attachment.extension.toLowerCase();

            if (['jpg', 'png', 'jpeg', 'gif'].includes(extension)) {


                var imgElement = document.createElement('img');
                imgElement.classList.add('img_group', 'clickable');
                imgElement.src = data.attachment.url;

                textContentDiv.appendChild(imgElement);
                if (data.message) {
                    var messageSpan = document.createElement('span');
                    messageSpan.classList.add('message');
                    messageSpan.textContent = data.message;
                    textContentDiv.appendChild(messageSpan);
                }
            } else {
                var attachmentLink = document.createElement('a');
                attachmentLink.href = data.attachment.url;
                attachmentLink.target = "_blank";
                attachmentLink.innerHTML = `<p class="message">${data.message}</p>`;
                textContentDiv.appendChild(attachmentLink);
            }
        } else {            console.log(789);

            var messageSpan = document.createElement('span');
            messageSpan.classList.add('message');
            messageSpan.textContent = data.message;
            textContentDiv.appendChild(messageSpan);
        }

        // إضافة الوقت
        var timeElement = document.createElement('time');
        timeElement.classList.add('time');
        timeElement.textContent = new Date(data.created_at).toLocaleString();
        textContentDiv.appendChild(timeElement);

        // تجميع الهيكل
        messageBodyDiv.appendChild(textContentDiv);
        messageDiv.appendChild(messageBodyDiv);
        chatDiv.appendChild(messageDiv);

        // التمرير التلقائي إلى الأسفل
        chatDiv.scrollTop = chatDiv.scrollHeight;

        // إضافة وظيفة عرض الصور الكبيرة
        const newImages = document.querySelectorAll(".img_group.clickable");
        newImages.forEach(addModalFunctionality);
    });


channelRequest.bind('App\\Events\\RequestEvent', function(data) {
    var newRequest = `

            <div class="media-body flex-grow-1 notification-item">
                <p class="notification-title">${translatedSendRequest}
                    <span class="details_notification">${data.client_name} :</span>
                    <span>
                        <a class="notification-link" href="/document/request/${data.document_encoded_id}/show">
                            <span class="notification-title">${data.document_title}</span>
                        </a>
                    </span>
                </p>
                <span class="notification-time">${new Date().toLocaleDateString('en-GB', {
                    day: 'numeric',
                    month: 'short',
                    year: 'numeric'
                })}</span>
            </div>

    `;

    notifications.prepend(newRequest);
    notificationsCount += 1;
    notificationsCountElem.text(notificationsCount);

    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});

channelClosedConsultation.bind('closedConsultationClient', function(data) {
    var newClosedConsultation = `
   <li class="notification-message">
        <div class="media d-flex">
            <div class="media-body flex-grow-1 notification-item">
                  <p class="notification-title">${translatedClosedConsultation}
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
                  <p class="notification-title">${translatedClosedRequest}
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
                  <p class="notification-title">${translatedClosedCase}
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
                <p class="notification-title">${translatedSendConsultation}
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
                <p class="notification-title">${translatedSendCase}
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
                <p class="notification-title">${translatedAcceptCase}
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
                <p class="notification-title">${translatedRejectCase}
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
