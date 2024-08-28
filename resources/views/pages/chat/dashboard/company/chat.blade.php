@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="chat-dashboard">
            <div class="container mt-3">
                <div class="d-flex justify-content-between align-items-center pb-2 mb-3">
                    <ul class="nav">

                        <li class="nav-item">
                            <a class="nav-dashboard" href="" data-target="clients"
                                onclick="openTab(event, 'clients')">@lang('pages.clients')</a>
                        </li>
                    </ul>

                </div>


                <div id="chats" class="tab-content active">
                    <div class="box-profile-chat box-profile-chat-dashboard">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 p-0 contact-list-dashboard">
                                    <div class="list-group">
                                        @foreach ($users as $user)
                                            <a href="{{ route('chat_company_form', base64_encode($user->id)) }}"
                                                class="list-group-item1" onclick="openChat('Jamie Chastain')">
                                                <div class="contact-info">
                                                    <img src="{{ $user->getFirstMediaUrl('profile') }}"
                                                        class="img-contact-dashboard" alt="User Image">
                                                    <div class="list_contact_info">
                                                        <div class="user-name">{{ $user->name }}</div>

                                                        @if($user->message_count<>0)

                                                        <div style="display: inline; ">

                                                            <span class="message-counter"
                                                                id="counter_chat_{{ $user->id }}">{{ $user->message_count }}</span>
                                                        </div>
                                                        @endif
                                                        <div class="message-contents">
                                                            <p
                                                                class="last-msg last-message-dashboard text-smoke"id="last_message_{{ $user->id }}">
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
                </div>

            </div>
        </div>
    {{--  </div>  --}}
@endsection
