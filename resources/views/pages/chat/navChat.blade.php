@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
    <div class="chat-dashboard">
        <div class="container mt-3">
            <div class="d-flex justify-content-between align-items-center pb-2 mb-3">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-dashboard " href="{{ route('chat_lawyer_dashboard') }}">@lang('pages.chats')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-dashboard" href="{{ route('group') }}">@lang('pages.groups')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-dashboard" href="{{ route('general_chat') }}">@lang('pages.forum')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-dashboard" href="{{ route('contact_dashboard') }}">@lang('pages.contacts')</a>
                    </li>
                    @role('lawyer')

                    <li class="nav-item">
                        <a class="nav-dashboard" href="{{ route('contact_client') }}" data-target="clients"
                            onclick="openTab(event, 'clients')">@lang('pages.clients')</a>
                    </li>
                    @endrole

                </ul>
                <div>
                    @role('lawyer|admin')
                        <a href="{{ route('add_group') }}" class="btn btn-outline-secondary">
                            <img src="{{ asset('assets/img/create_group.png') }}">
                        </a>
                    @endrole

                    {{--  @role('admin')
                        <a href="{{ route('add_general_chat') }}" class="btn btn-outline-secondary">
                            <img class="icon-forum" src="{{ asset('assets/img/forum.png') }}">
                        </a>
                    @endrole  --}}
                </div>
            </div>

            @yield('content_chat')

        </div>
    </div>
    {{--  </div>  --}}
@endsection
