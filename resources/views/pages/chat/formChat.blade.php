@extends('pages.chat.chat')
@section('chat_form_content')

    <div class="col-lg-7 col-xxl-8">
        <!-- Chat -->
        <div class="card card-default chat-right-sidebar">
            <div class="card-header">
                @if ($role_receiver == 'client')
                    @php
                        $encodedIdClient = base64_encode($receiver->id);

                    @endphp
                    <a href="{{ route('show_client', $encodedIdClient) }}">
                        <h2> <img src="{{ $receiver->getFirstMediaUrl('profileUser') }}" class="rounded-circle img_list_chat"
                                alt="user_img">
                            {{ $receiver->name }}</h2>
                    </a>
                @else
                    @php
                        $encodedIdLawyer = base64_encode($receiver->id);

                    @endphp
                    <a href="{{ route('show_lawyer', $encodedIdLawyer) }}">
                        <h2> <img src="{{ $receiver->getFirstMediaUrl('profileUser') }}" class="rounded-circle img_list_chat"
                                alt="user_img">
                            {{ $receiver->name }}</h2>
                    </a>
                @endif
            </div>



            <div class="card-body pb-0" style="max-height: 450px; overflow-y: auto;" id="chat_div">
                @if ($messages->isEmpty())
                    <div class="empty-messages">
                        <p>@lang('pages.empty_message')</p>
                    </div>
                @else

                    @foreach ($messages as $message)
                        @if ($message->sender_id == auth()->user()->id)
                            <!-- Media Chat Right -->
                            <div class="media media-chat media-chat-right" id="chat_area_sender">
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
                                                    <p class="message">{{ $message->message }}</p> </a>
                                            @endif
                                        @else
                                            <span class="message">{{ $message->message }}</span>
                                        @endif
                                        <time class="time">{{ $message->created_at->diffForHumans() }}</time>
                                    </div>
                                    @php
                                        $encodedIdSender = base64_encode(auth()->user()->id);

                                    @endphp
                                    {{--  <a href="{{ route('show_lawyer', $encodedIdSender) }}">
                                        <img src="{{ auth()->user()->getFirstMediaUrl('profileUser') }}"
                                            class="rounded-circle img_group" alt="user_img">

                                    </a>  --}}
                                </div>
                            </div>
                        @else
                            <!-- Media Chat Left -->
                            @php
                                $encodedIdReceiver = base64_encode($message->sender->id);

                            @endphp
                            <div class="media media-chat" id="chat_area_receiver">
                                <div class="media-body">

                                    <div class="text-content" >
                                        @if ($message->getFirstMediaUrl('attachments') != null)
                                            @if (
                                                $message->getMedia('attachments')->first()->extension == 'jpg' ||
                                                    $message->getMedia('attachments')->first()->extension == 'png')
                                                <img class=" img_group"
                                                    src="{{ asset($message->getFirstMediaUrl('attachments')) }}">
                                                <span class="message">{{ $message->message }}</span>
                                            @else
                                                <a href="{{ asset($message->getFirstMediaUrl('attachments')) }}"
                                                    target="_blank"> <p class="message">{{ $message->message }}</p>
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
                    $encodedIdReceiver = base64_encode($receiver->id);

                @endphp
                <form action="{{ route('send_message_to_user', $encodedIdReceiver) }}" method="POST"
                    enctype="multipart/form-data" >
                    @csrf
                    <div class="input-group input-group-chat">
                        <label for="fileInput">
                            <i class="fas fa-paperclip"></i>
                        </label>
                        <input id="fileInput" type="file" name="attachments" style="display: none;">

                        <input  type="text" name="message" class="form-control"
                            aria-label="Text input with dropdown button" placeholder=@lang('pages.type_message')>
                        <div class="input-group-append">

                            <button class="btn btn-primary send-button" type="submit">@lang('pages.send')</button>
                            <a href="{{ route('attachments', $encodedIdReceiver) }}" id="openAllAttachments"
                                class="btn btn-secondary">
                                <i class="fas fa-folder-open"></i> @lang('pages.open_attachments')</a>


                        </div>
                    </div>
                </form>

            </div>


        </div>
    </div>



@endsection
