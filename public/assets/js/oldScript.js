

$(document).ready(function () {
    $('#myTab a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
        var target = $(this).attr('href');
        loadContent(target);
    });

    function loadContent(target) {
    }
});


const fileInput = document.getElementById('fileInput');
fileInput.addEventListener('change', function () {
    const fileName = this.files[0].name;
    document.querySelector('textarea[name="message"]').value = fileName;
});


$(document).ready(function () {
    $('.send-button').click(function (e) {
        e.preventDefault();

        var form = $(this).closest('form');
        var formData = new FormData(form[0]);

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                form.find('textarea[name="message"]').val('');

                // إنشاء عناصر DOM لعرض الرسالة الجديدة
                var messageElement = $('<div class="media media-chat media-chat-right"></div>');
                var mediaBody = $('<div class="media-body"></div>');
                var textContent = $('<div class="text-content"></div>');
                var timeText = $('<time class="time"></time>').text(response.created_at);

                // تحقق من وجود مرفقات في الاستجابة
                if (response.attachment) {
                    var attachment = response.attachment;
                    if (attachment.extension === 'jpg' || attachment.extension === 'png') {
                        var imgElement = $('<img class="img_group clickable">').attr('src', attachment.url);
                        textContent.append(imgElement);
                        var messageText = $('<span class="message"></span>').text(response.message);
                        textContent.append(messageText);

                        // أضف وظيفة الـ Modal للصورة الجديدة
                        addModalFunctionality(imgElement[0]);

                    } else {
                        var fileLink = $('<a></a>').attr('href', attachment.url).attr('target', '_blank');
                        var messageText = $('<p class="message"></p>').text(response.message);
                        fileLink.append(messageText);
                        textContent.append(fileLink);
                    }
                } else {
                    var messageText = $('<span class="message"></span>').text(response.message);
                    textContent.append(messageText);
                }

                textContent.append(timeText);
                mediaBody.append(textContent);
                messageElement.append(mediaBody);

                // إزالة رسالة "لا توجد رسائل" إذا كانت موجودة
                if ($('.empty-messages').length > 0) {
                    $('.empty-messages').remove();
                }

                // إضافة الرسالة الجديدة إلى المحادثة
                $('#chat_div').append(messageElement);

                // تحديث آخر رسالة في قائمة المحادثات
                $('#last_message_' + response.receiver_id).text(response.message);

                // إضافة محادثة جديدة إذا كانت هذه هي الرسالة الأولى
                if (response.has_previous_chat) {
                    let newChatMessageReceiver = `
                    <li id="new_chat_div">
                        <a href="/chat/dashboard/${response.receiver_encoded_id}" class="list-group-item1">
                            <div class="contact-info">
                                    <img  src="${response.receiver_profile}" alt="User Image">
                                    <div>
                                <div class="user-name title-group">${response.receiver_name}</div>
                                <div class="last-message  last_msg_form_chat">
                                           ${response.message}</div>
                                        <div class="last-seen"> ${response.created_at}
                                        </div>
                                    </div>
                                </div>     </a>
                        </li>
                    `;

                    $("#new_chat_div").append(newChatMessageReceiver);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});









