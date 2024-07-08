@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="chat-dashboard">
            <div class="container mt-3">
                <div class="d-flex justify-content-between align-items-center pb-2 mb-3">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-dashboard " href="{{ route('chat_lawyer_dashboard') }}">Chats</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-dashboard" href="{{ route('group') }}">Groups</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-dashboard" href="{{ route('general_chat') }}" >The Forum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-dashboard" href="{{ route('contact_dashboard') }}">Contacts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-dashboard" href="{{ route('contact_client') }}" data-target="clients"
                                onclick="openTab(event, 'clients')">Clients</a>
                        </li>
                    </ul>
                    <div>
                        @role('lawyer|admin')
                        <a href="{{ route('add_group') }}" class="btn btn-outline-secondary">
                            <img src="{{ asset('assets/img/create_group.png') }}">
                        </a>
                        @endrole
                    </div>
                </div>

                @yield('content_chat')

            </div>
        </div>
    </div>
@endsection
