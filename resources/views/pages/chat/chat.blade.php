@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content-wrapper">
            <div class="content">
                <div class="row no-gutters">
                    <div class="col-lg-5 col-xxl-4">
                        <div class="card card-default chat-left-sidebar">
                            <form method="GET" action="{{ route('chat') }}" class="card-header px-0">
                                @csrf
                                <div class="input-group px-5">
                                    <input type="text" name="name" class="form-control"
                                        aria-label="Text input with dropdown button" placeholder="Search here...">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>

                                </div>
                            </form>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="chats-tab" data-toggle="tab" href="#chats"
                                        role="tab" aria-controls="chats" aria-selected="true">Chats</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="groups-tab" data-toggle="tab" href="#groups" role="tab"
                                        aria-controls="groups" aria-selected="false">Groups</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contacts-tab" data-toggle="tab" href="#contacts" role="tab"
                                        aria-controls="contacts" aria-selected="false">Contacts</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="chats" role="tabpanel" aria-labelledby="chats-tab">
                                    <ul class="card-body px-0" style="height: 450px; overflow-y: auto;">
                                        @foreach ($users as $user)
                                            <li class="mb-4 px-5 py-2">
                                                <a href="javascript:void(0)" class="media media-message">
                                                    <div class="position-relative mr-3">
                                                        <a href="{{ route('chat_form', $user->id) }}">
                                                            <img class="rounded-circle img_list_chat"
                                                                src="{{ asset($user->getFirstMediaUrl('profileUser')) }}"
                                                                alt="User Image">
                                                            <span class="username text-dark">{{ $user->name }}</span>
                                                        </a>
                                                        <span class="status away"></span>

                                                        <div class="message-contents">
                                                            <p class="last-msg text-smoke">
                                                                {{ $user->latest_message?->message }}</p>

                                                            {{--  <span class="d-flex justify-content-between align-items-center mb-1">  --}}

                                                            <span
                                                                class="text-smoke time_message"><em>{{ $user->latest_message?->created_at->diffForHumans() }}</em></span>

                                                            {{--  </span>  --}}
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>


                                <div class="tab-pane fade" id="groups" role="tabpanel" aria-labelledby="groups-tab">
                                    <ul class="card-body px-0" style="height: 450px; overflow-y: auto;">
                                        @foreach ($groups as $group)
                                            <li class="mb-4 px-5 py-2">
                                                <a href="javascript:void(0)" class="media media-message">
                                                    <div class="position-relative mr-3">
                                                        <a href="{{ route('group_form', $group->id) }}">

                                                            <i class="fas fa-users"></i>

                                                            <span class="username text-dark">{{ $group->name }}</span>
                                                        </a>
                                                        <span class="status away"></span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>


                                <div class="tab-pane fade" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                                    <ul class="card-body px-0" style="height: 450px; overflow-y: auto;">
                                        @foreach ($lawyers as $lawyer)
                                            <li class="mb-4 px-5 py-2">
                                                <a href="javascript:void(0)" class="media media-message">
                                                    <div class="position-relative mr-3">
                                                        <a href="{{ route('chat_form', $lawyer->id) }}">
                                                            <img class="rounded-circle img_list_chat"
                                                                src="{{ asset($lawyer->getFirstMediaUrl('profileUser')) }}"
                                                                alt="User Image">
                                                            <span class="username text-dark">{{ $lawyer->name }}</span>
                                                        </a>
                                                        <span class="status away"></span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    @yield('chat_form_content')

                </div>

            </div>

        </div>
    </div>
@endsection