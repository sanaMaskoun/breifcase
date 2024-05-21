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


var channelConsultation = pusherPrivate.subscribe('private-consultation-channel-' + localStorage.getItem('user_id'));
var channelReplayRate = pusherPrivate.subscribe('private-rate-channel-' + localStorage.getItem('user_id'));



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



//new chat
var channelPivateNewChat = pusherPrivate.subscribe('private-new-chat-channel-' + localStorage.getItem('user_id'));
channelPivateNewChat.bind('newChatMessage', function (data) {
    let newChatMessageSender = `
    <li class="mb-4 px-5 py-2" id="new_chat_div">
        <a href="javascript:void(0)" class="media media-message">
            <div class="position-relative mr-3">
                <a href="/chat/${data.sender_encoded_id}">
                    <img class="rounded-circle img_list_chat" src="${data.sender_profile}" alt="User Image">
                    <span class="username text-dark">${data.sender_name}</span>
                </a>
                <span class="message-counter" id="counter_chat_${data.sender_id}">${data.message_count}</span>

                <div class="message-contents">
                    <p class="last-msg text-smoke" id="last_message_${data.sender_id}">${data.message}</p>
                    <span class="text-smoke time_message"><em>${data.created_at}</em></span>
                </div>
            </div>
        </a>
    </li>`;

    let newChatMessageReceiver = `
    <li class="mb-4 px-5 py-2" id="new_chat_div">
        <a href="javascript:void(0)" class="media media-message">
            <div class="position-relative mr-3">
                <a href="/chat/${data.receiver_encoded_id}">
                    <img class="rounded-circle img_list_chat" src="${data.receiver_profile}" alt="User Image">
                    <span class="username text-dark">${data.receiver_name}</span>
                </a>
                <div class="message-contents">
                    <p class="last-msg text-smoke">${data.message}</p>
                    <span class="text-smoke time_message"><em>${data.created_at}</em></span>
                </div>
            </div>
        </a>
    </li>`;
    if (data.sender_id == localStorage.getItem('user_id')) {

        // newMessage = newChatMessageReceiver;
        $("#new_chat_div").append(newChatMessageReceiver);
    }
    else if (data.receiver_id == localStorage.getItem('user_id')) {
        // newMessage = newChatMessageSender;
        $("#new_chat_div").append(newChatMessageSender);
    }


    // $("#new_chat_div").append(newChatMessage);
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


//chat
var channelPivateChat = pusherPrivate.subscribe('private-chat-channel-' + localStorage.getItem('user_id'));
channelPivateChat.bind('chatMessage', function (data) {
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
// var channelChat = pusher.subscribe('group-channel');
// channelChat.bind('groupMessage', function (data) {
//     var extension = data.attachment ? data.attachment.split('.').pop().toLowerCase() : null;
//     message_group = "";

//     let receiverMessage = `
//     <div class="media media-chat" id="group_area_receiver">
//         <div class="media-body img-groups">
//         <a href="/lawyer/${data.sender_id_encoded}/show">
//         <img class="rounded-circle img_group" src="${data.sender_profile}">
//         <span>${data.sender_name}</span>
//         </a>
//             <div class="text-content">
//                 ${data.attachment ?
//             (extension === 'jpg' || extension === 'png' ?
//                 `<img class="img_group" src="${data.attachment}">` :
//                 `<a href="${data.attachment}" target="_blank"><p class="message">${data.message}</p></a>`) :
//             `<p class="message">${data.message} </p>`}
//                 <time class="time">${data.created_at}</time>
//             </div>
//         </div>
//     </div>`;

//     let senderMessage = `
//     <div class="media media-chat media-chat-right" id="group_area_sender">
//     <div class="media-body">
//     <div class="text-content">
//     ${data.attachment ?
//             (extension === 'jpg' || extension === 'png' ?
//                 `<img class="img_group" src="${data.attachment}">` :
//                 `<a href="${data.attachment}" target="_blank"><p class="message">${data.message}</p></a>`) :
//             `<p class="message">${data.message} </p>`}
//     <time class="time">${data.created_at}</time>
// </div>
//     <a href="/lawyer/${data.sender_id_encoded}/show">
//     <img class="rounded-circle img_group" src="${data.sender_profile}">
//     </a>

//     </div>
//     </div>`;

//     if (data.sender_id == localStorage.getItem('user_id')) {
//         message_group = senderMessage;
//     }
//     else {
//         message_group = receiverMessage;
//     }
//     if (message_group != "") {
//         $('.empty-messages').remove();
//     }


//     $("#group_div").append(message_group);


// });


