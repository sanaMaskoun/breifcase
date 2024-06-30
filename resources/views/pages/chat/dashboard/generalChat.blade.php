@extends('pages.chat.navChat')
@section('content_chat')


            <div id="chats" class="tab-content active">
                <div class="box-profile-chat box-profile-chat-dashboard">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 p-0 contact-list-dashboard">
                                <div class="list-group">
                                    @foreach ($general_chats as $general_chat)
                                        <a href="{{ route('general_chat_form', base64_encode($general_chat->id)) }}" class="list-group-item1"
                                            onclick="openChat('Jamie Chastain')">
                                            <div class="contact-info">

                                                    <i class="fas fa-users icon-group-dashboard"></i>


                                                <div class="list_contact_info">
                                                    <div class="user-name">{{ $general_chat->name }}</div>

                                                    <div style="display: inline; ">
                                                        <span class="message-counter"
                                                            id="counter_chat_{{ $general_chat->id }}">{{ $general_chat->message_count }}</span>
                                                    </div>
                                                    <div class="message-contents">
                                                        <p class="last-msg last-message-dashboard text-smoke"id="last_message_{{ $general_chat->id }}">
                                                            {{ $general_chat->latest_message?->message }} </p>
                                                        <span
                                                            class="text-smoke time_message"><em>{{ $general_chat->latest_message?->created_at->diffForHumans() }}</em></span>

                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>







@endsection
