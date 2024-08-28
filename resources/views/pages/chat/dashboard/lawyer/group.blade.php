@extends('pages.chat.navChat')
@section('content_chat')


            <div id="chats" class="tab-content active">
                <div class="box-profile-chat box-profile-chat-dashboard">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 p-0 contact-list-dashboard">
                                <div class="list-group">
                                    @foreach ($groups as $group)
                                        <a href="{{ route('group_form', base64_encode($group->id)) }}" class="list-group-item1"
                                            onclick="openChat('Jamie Chastain')">
                                            <div class="contact-info">

                                                    <i class="fas fa-users icon-group-dashboard"></i>


                                                <div class="list_contact_info">
                                                    <div class="user-name">{{ $group->name }}</div>

                                                    @if($group->message_count<>0)

                                                    <div style="display: inline; ">
                                                        <span class="message-counter"
                                                            id="counter_chat_{{ $group->id }}">{{ $group->message_count }}</span>
                                                    </div>
                                                    @endif
                                                    <div class="message-contents">
                                                        <p class="last-msg last-message-dashboard text-smoke"id="last_message_{{ $group->id }}">
                                                            {{ $group->latest_message?->message }} </p>
                                                        <span
                                                            class="text-smoke time_message"><em>{{ $group->latest_message?->created_at->diffForHumans() }}</em></span>

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
