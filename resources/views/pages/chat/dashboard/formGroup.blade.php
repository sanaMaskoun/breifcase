@extends('pages.chat.navChat')
@section('content_chat')
    <div class="box-profile-chat box-profile-chat-dashboard">


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-4 p-0  contact_list_form_chat" id="contact-list">
                    <div class="list-group">
                        @foreach ($groups as $object)
                            <a href="{{ route('group_form', base64_encode($object->id)) }}" class="list-group-item1"
                                onclick="openChat('Jamie Chastain')">
                                <div class="contact-info">
                                    <i class="fas fa-users icon-group-dashboard"></i>
                                    <div>
                                        <div class="user-name title-group">{{ $object->name }}</div>
                                        <div class="last-message  last_msg_form_chat" id="last_message_{{ $object->id }}">
                                            {{ $object->latest_message?->message }}</div>
                                        <div class="last-seen"> {{ $object->latest_message?->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                                <span class="badge-2"
                                    id="counter_chat_{{ $object->id }}">{{ $object->message_count }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>



                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div id="chat-area" class="card card_form_chat card-chat-dashboard">
                        <div id="chat-header_1">
                            <i class="fas fa-users icon-group-dashboard"></i>
                            <span class="title-name-form-chat">{{ $group->name }}</span>
                            <button id="fullscreen-button" class="btn">
                                <i id="fullscreen-icon" class="fas fa-expand fullscreen-icon"></i>
                            </button>
                            <button id="exit-fullscreen-button" class="btn" style="display: none;">
                                <i id="exit-fullscreen-icon" class="fas fa-compress fullscreen-icon"></i>
                            </button>
                        </div>

                        <div class="card-body pb-0" style="max-height: 450px; overflow-y: auto;" id="group_div">
                            @if ($messages->isEmpty())
                                <div class="empty-messages">
                                    <p>@lang('pages.empty_message')</p>
                                </div>
                            @else
                                @foreach ($messages as $message)
                                    @if ($message->sender_id == auth()->user()->id)
                                        <!-- Media Chat Right -->
                                        <div class="media media-chat media-chat-right" id="group_area_sender">
                                            <div class="media-body">
                                                <div class="text-content">
                                                    @if ($message->getFirstMediaUrl('attachments') != null)
                                                        @if (
                                                            $message->getMedia('attachments')->first()->extension == 'jpg' ||
                                                                $message->getMedia('attachments')->first()->extension == 'png')
                                                            <img class=" img_group clickable"
                                                                src="{{ asset($message->getFirstMediaUrl('attachments')) }}">
                                                            <span class="message">{{ $message->message }}</span>
                                                        @else
                                                            <a href="{{ $message->getFirstMediaUrl('attachments') }}"
                                                                target="_blank">
                                                                <p class="message">{{ $message->message }}</p>
                                                            </a>
                                                        @endif
                                                    @else
                                                        <span class="message">{{ $message->message }}</span>
                                                    @endif
                                                    <time class="time">{{ $message->created_at->diffForHumans() }}</time>
                                                </div>
                                                {{--  <a href="{{ route('show_lawyer',base64_encode(auth()->user()->id)) }}">  --}}
                                                <img src="{{ auth()->user()->getFirstMediaUrl('profile') }}"
                                                    class="rounded-circle img_group" alt="user_img">

                                                {{--  </a>  --}}
                                            </div>
                                        </div>
                                    @else
                                        <!-- Media Chat Left -->
                                        <div class="media media-chat" id="group_area_receiver">
                                            <div class="media-body img-groups">

                                                {{--  <a href="{{ route('show_lawyer',base64_encode($message->sender->id)) }}">  --}}
                                                <img src="{{ $message->sender->getFirstMediaUrl('profile') }}"
                                                    class="rounded-circle img_group" alt="user_img">
                                                {{--  <span>{{ $message->sender->name }}</span>  --}}
                                                {{--  </a>  --}}

                                                <div class="text-content">
                                                    @if ($message->getFirstMediaUrl('attachments') != null)
                                                    @if (  $message->getMedia('attachments')->first()->extension == 'jpg' ||
                                                            $message->getMedia('attachments')->first()->extension == 'png')
                                                        <img class=" img_group clickable"
                                                            src="{{ asset($message->getFirstMediaUrl('attachments')) }}">
                                                        <span class="message">{{ $message->message }}</span>
                                                    @else
                                                        <a href="{{ $message->getFirstMediaUrl('attachments') }}"
                                                            target="_blank">
                                                            <p class="message">{{ $message->message }}</p>
                                                        </a>
                                                    @endif
                                                @else
                                                    <span class="message">{{ $message->message }}</span>
                                                @endif
                                                    <time class="time">{{ $message->created_at->diffForHumans() }}</time>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{--  <br>  --}}
                                @endforeach
                            @endif
                        </div>

                        <div class="chat-footer">

                            <form id="messageForm" action="{{ route('send_message_to_group', base64_encode($group->id)) }}"
                                method="POST" enctype="multipart/form-data" class="form_chat_profile">
                                @csrf
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-10 d-flex align-items-center">
                                            <textarea name="message" class="form-control message-input" placeholder="@lang('pages.type_message')"></textarea>
                                            <button class="btn  send-button" type="submit"><i
                                                    class="fas fa-paper-plane"></i></button>
                                        </div>

                                        <div class="col-lg-2 d-flex justify-content-center align-items-center">
                                            <label for="fileInput" class="send_file_chat">
                                                <i class="fas fa-paperclip"></i>
                                            </label>
                                            <input id="fileInput" type="file" name="attachments" style="display: none;">

                                            <a href="{{ route('attachments', base64_encode($group->id)) }}"
                                                id="openAllAttachments" class="btn ">
                                                <i class="fas fa-folder-open"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group input-group-chat">
                                    <div class="input-group-append"></div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>





            </div>
        </div>





    </div>
@endsection
@section('scripts')
    <script>
        var channelChat = pusher.subscribe('group-channel-{{ $group->id }}');
        channelChat.bind('groupMessage', function(data) {
            var extension = data.attachment ? data.attachment.extension.toLowerCase() : null;
            message_group = "";

            let receiverMessage = `
            <div class="media media-chat" id="group_area_receiver">
            <div class="media-body img-groups">
            <img class="rounded-circle img_group" src="${data.sender_profile}">
            </a>
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
            <div class="media media-chat media-chat-right" id="group_area_sender">
            <div class="media-body">
            <div class="text-content">
            ${data.attachment ?
                (extension === 'jpg' || extension === 'png' ?
                    `<img class="img_group clickable" src="${data.attachment.url}">
                     <span class="message">${data.message}</span>` :
                    `<a href="${data.attachment.url}" target="_blank"><p class="message">${data.message}</p></a>`) :
                `<p class="message">${data.message} </p>`}
           <time class="time">${data.created_at}</time>
             </div>
            <img class="rounded-circle img_group" src="${data.sender_profile}">


            </div>
            </div>`;

            if (data.sender_id == localStorage.getItem('user_id')) {
                message_group = senderMessage;
            } else {
                message_group = receiverMessage;
            }
            if (message_group != "") {
                $('.empty-messages').remove();
            }


            $("#group_div").append(message_group);


        });
    </script>
@endsection
