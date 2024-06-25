@extends('pages.client.details')

@section('profile_content')
    <div class="box-profile-chat">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 p-0" id="contact-list">
                    <div class="list-group">
                        @foreach ($users as $user)
                            @php
                                $receiver_encoded_id = base64_encode($user->id);

                            @endphp
                            <a href="{{ route('chat_form' ,$receiver_encoded_id) }}" class="list-group-item1" onclick="openChat('Jamie Chastain')">
                                <div class="contact-info">
                                    <img src="{{ $user->getFirstMediaUrl('profile') }}" alt="User Image">
                                    <div class="list_contact_info">
                                        <div class="user-name">{{ $user->name }}</div>

                                        <div style="display: inline; ">
                                            <span class="message-counter"
                                                id="counter_chat_{{ $user->id }}">{{ $user->message_count }}</span>
                                        </div>
                                        <div class="message-contents">
                                            <p class="last-msg text-smoke"id="last_message_{{ $user->id }}">
                                                {{ $user->latest_message?->message }} </p>
                                            <span
                                                class="text-smoke time_message"><em>{{ $user->latest_message?->created_at->diffForHumans() }}</em></span>

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
@endsection
