@extends('pages.chat.navChat')
@section('content_chat')

    <head>
        <style>
            #chat-header_1 .btn {
                margin-left: 10px;
            }

            .img-icon-template {
                width: 35px !important;
                height: 35px !important;
            }

            .btn-dropdown-toggle {
                padding: 0;
                /* Remove any padding */
                width: 50px !important;
                /* Set the width */
                height: 50px !important;
                /* Set the height */
                border: none;
                /* Remove border */
                background: none;
                /* Remove background */

            }

            .dropdown-toggle::after {
                content: none;
            }

            .dropdown-menu.show {
                overflow-y: scroll;
                height: 160px;
            }

            .btn-dropdown-toggle img {
                font-size: 24px;
                /* Adjust the size of the icon */
                height: 100%;
                width: 100%;
                border-radius: 0px !important;
            }

            .dropdown-menu {
                min-width: 100px;
                /* Adjust as needed */
            }
        </style>
    </head>
    <div class="box-profile-chat box-profile-chat-dashboard">


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-4 p-0  contact_list_form_chat" id="contact-list">
                    <div class="list-group">
                        @foreach ($users as $user)
                            <a href="{{ route('lawyer_form_dashboard', base64_encode($user->id)) }}" class="list-group-item1"
                                onclick="openChat('Jamie Chastain')">
                                <div class="contact-info">
                                    <img src="{{ $user->getFirstMediaUrl('profile') }}" alt="User Image">
                                    <div>
                                        <div class="user-name title-group">{{ $user->name }}</div>
                                        <div class="last-message  last_msg_form_chat" id="last_message_{{ $user->id }}">
                                            {{ $user->latest_message?->message }}</div>
                                        <div class="last-seen"> {{ $user->latest_message?->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                                <span class="badge-2"
                                    id="counter_chat_{{ $user->id }}">{{ $user->message_count }}</span>
                            </a>
                        @endforeach

                    </div>
                </div>



                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div id="chat-area" class="card card_form_chat card-chat-dashboard">
                        <div id="chat-header_1">
                            <img src="{{ $receiver->getFirstMediaUrl('profile') }}" class="img_contact">
                            <span class="title-name-form-chat">{{ $receiver->name }}</span>

                            <div class="dropdown">

                                <button id="fullscreen-button" class="btn">
                                    <i id="fullscreen-icon" class="fas fa-expand fullscreen-icon"></i>
                                </button>

                                <button id="exit-fullscreen-button" class="btn" style="display: none;">
                                    <i id="exit-fullscreen-icon" class="fas fa-compress fullscreen-icon"></i>
                                </button>

                                <button class="btn btn-dropdown-toggle dropdown-toggle" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <img class="img-icon-template" alt=""
                                        src="{{ asset('assets/img/template-dashboard.png') }}">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach ($templates as $template)
                                        <a class="dropdown-item" href="{{ route('create_case' ,[ base64_encode($template->id) , base64_encode($receiver->id)]) }}"
                                            data-file-name="document1.pdf">{{ $template->title }}</a>
                                    @endforeach

                                </div>
                            </div>



                        </div>


                        <div class="card-body pb-0 card_body_form_chat" id="chat_div">
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
                                    @else
                                        <!-- Media Chat Left -->
                                        <div class="media media-chat" id="chat_area_receiver">
                                            <div class="media-body">

                                                <div class="text-content">
                                                    @if ($message->getFirstMediaUrl('attachments') != null)
                                                        @if (
                                                            $message->getMedia('attachments')->first()->extension == 'jpg' ||
                                                                $message->getMedia('attachments')->first()->extension == 'png')
                                                            <img class="img_group clickable"
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

                            <form id="messageForm"
                                action="{{ route('send_message_to_user', base64_encode($receiver->id)) }}" method="POST"
                                enctype="multipart/form-data" class="form_chat_profile">
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

                                            <a href="{{ route('attachments', base64_encode($receiver->id)) }}"
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
