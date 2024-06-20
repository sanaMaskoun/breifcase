

document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const memberCheckboxes = document.querySelectorAll('.member-checkbox');

    function updateFieldStates() {
        if (roleSelect.value) {
            memberCheckboxes.forEach(checkbox => {
                checkbox.disabled = true;
                checkbox.checked = false;
            });
        } else {
            memberCheckboxes.forEach(checkbox => {
                checkbox.disabled = false;
            });
        }
    }

    roleSelect.addEventListener('change', updateFieldStates);

    updateFieldStates();
});


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
    document.querySelector('input[name="message"]').value = fileName;
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
                form.find('input[type="text"]').val('');

                var messageElement = $('<div class="media media-chat media-chat-right"></div>');
                var mediaBody = $('<div class="media-body"></div>');
                var textContent = $('<div class="text-content"></div>');
                var messageText = $('<span class="message"></span>').text(response.message);
                var timeText = $('<time class="time"></time>').text(response.created_at);

                textContent.append(messageText);
                textContent.append(timeText);
                mediaBody.append(textContent);

                messageElement.append(mediaBody);
                if (messageElement != "") {
                    $('.empty-messages').remove();
                }
                $('#chat_div').append(messageElement);

                var lastMessage = response.message;
                $('#last_message_' + response.receiver_id).text(lastMessage);

                if (response.has_previous_chat) {
                    let newChatMessageReceiver = `
                    <li class="mb-4 px-5 py-2" id="new_chat_div">
                        <a href="javascript:void(0)" class="media media-message">
                            <div class="position-relative mr-3">
                                <a href="/chat/${response.receiver_encoded_id}">
                                    <img class="rounded-circle img_list_chat" src="${response.receiver_profile}" alt="User Image">
                                    <span class="username text-dark">${response.receiver_name}</span>
                                </a>
                                <div class="message-contents">
                                    <p class="last-msg text-smoke">${response.message}</p>
                                    <span class="text-smoke time_message"><em>${response.created_at}</em></span>
                                </div>
                            </div>
                        </a>
                    </li>`;
                    $("#new_chat_div").append(newChatMessageReceiver);
                }


                // console.log(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});


