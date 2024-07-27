@extends('pages.chat.navChat')
@section('content_chat')


            <div id="chats" class="tab-content active">
                <div class="box-profile-chat box-profile-chat-dashboard">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 p-0 contact-list-dashboard">
                                <div class="search-status mt-2">
                                    <input value="{{ request('search') }}" name="search" type="text" class="form-control form-input input-search-status"
                                        id="statusSearch" placeholder="@lang('pages.search')" />
                                </div>
                                
                                <div class="list-group" id="userList">
                                    @foreach ($users as $user)
                                        <a href="{{ route('lawyer_form_dashboard', base64_encode($user->id)) }}" class="list-group-item1 user-card"
                                            onclick="openChat('Jamie Chastain')">
                                            <div class="contact-info">
                                                <img src="{{ $user->getFirstMediaUrl('profile') }}" class="img-contact-dashboard" alt="User Image">
                                                <div class="list_contact_info list_contact_info-dashboard">
                                                    <div class="user-name">{{ $user->name }}</div>

                                                    <div class="icon-message-contact">
                                                        <img src="{{ asset('assets/img/msg.png') }}" class="img-message-contact">

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
