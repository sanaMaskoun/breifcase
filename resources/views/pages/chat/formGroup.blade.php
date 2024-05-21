@extends('pages.chat.chat')
@section('chat_form_content')
    <div class="col-lg-7 col-xxl-8">
        <!-- Chat -->
        <div class="card card-default chat-right-sidebar">
            <div class="card-header">
                <h2 class="name_group"><i class="fas fa-users"></i> {{ $group->name }}</h2>

                <span class="admin-status">
                    @if ($admin)
                        <i class="fas fa-crown"></i>
                    @endif
                </span>

                @if ($admin)
                    @php
                        $encodedId = base64_encode($group->id);
                    @endphp
                    <form method="GET" action="{{ route('edit_group', $encodedId) }}">
                        <label class="edit_group">
                            <button type="submit" class="btn"> <i class="feather-edit-3"></i></button>
                        </label>
                    </form>
                @endif
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
                                                <img class=" img_group"
                                                    src="{{ asset($message->getFirstMediaUrl('attachments')) }}">
                                                <span class="message">{{ $message->message }}</span>
                                            @else
                                                <a href="{{ $message->getFirstMediaUrl('attachments') }}" target="_blank">
                                                    <p class="message">{{ $message->message }}</p>
                                                </a>
                                            @endif
                                        @else
                                            <span class="message">{{ $message->message }}</span>
                                        @endif
                                        <time class="time">{{ $message->created_at->diffForHumans() }}</time>
                                    </div>
                                    @php
                                        $encodedIdSender = base64_encode(auth()->user()->id);

                                    @endphp
                                    <a href="{{ route('show_lawyer', $encodedIdSender) }}">
                                        <img src="{{ auth()->user()->getFirstMediaUrl('profileUser') }}"
                                            class="rounded-circle img_group" alt="user_img">

                                    </a>
                                </div>
                            </div>
                        @else
                            <!-- Media Chat Left -->
                            @php
                                $encodedIdReceiver = base64_encode($message->sender->id);

                            @endphp
                            <div class="media media-chat" id="group_area_receiver">
                                <div class="media-body img-groups">

                                    <a href="{{ route('show_lawyer', $encodedIdReceiver) }}">
                                        <img src="{{ $message->sender->getFirstMediaUrl('profileUser') }}"
                                            class="rounded-circle img_group" alt="user_img">
                                        <span>{{ $message->sender->name }}</span>
                                    </a>

                                    <div class="text-content">
                                        @if ($message->getFirstMediaUrl('attachments') != null)
                                            @if (
                                                $message->getMedia('attachments')->first()->extension == 'jpg' ||
                                                    $message->getMedia('attachments')->first()->extension == 'png')
                                                <img class=" img_group"
                                                    src="{{ asset($message->getFirstMediaUrl('attachments')) }}">
                                                <span class="message">{{ $message->message }}</span>
                                            @else
                                                <a href="{{ asset($message->getFirstMediaUrl('attachments')) }}"
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
                @php
                    $encodedIdGroup = base64_encode($group->id);

                @endphp
                <form action="{{ route('send_message_to_group', $encodedIdGroup) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    <div class="input-group input-group-chat">
                        <label for="fileInput">
                            <i class="fas fa-paperclip"></i>
                        </label>
                        <input id="fileInput" type="file" name="attachments[]" multiple style="display: none;">

                        <input type="text" name="message" class="form-control"
                            aria-label="Text input with dropdown button" placeholder=@lang('pages.type_message')>
                        <div class="input-group-append">
                            <button class="btn btn-primary send-button" type="submit">@lang('pages.send')</button>
                            <a href="{{ route('attachments_group', $encodedIdGroup) }}" id="openAllAttachments"
                                class="btn btn-secondary">
                                <i class="fas fa-folder-open"></i> @lang('pages.open_attachments')</a>


                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>



@endsection
@section('scripts')
    <script>
        
        var channelChat = pusher.subscribe('group-channel-{{ $group->id }}');
        channelChat.bind('groupMessage', function(data) {
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
