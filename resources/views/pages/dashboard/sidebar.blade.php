@extends('master.app')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-lg-3 col-md-12 col-sm-12 sidebar-dashboard ">

                @role('lawyer')
                    <a href="{{ route('lawyer_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/dashboard.png') }}" class="icon-dashboard-sidebar">
                        @lang('pages.dashboard')
                    </a>
                @endrole
                @role('translation_company')
                    <a href="{{ route('company_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/dashboard.png') }}" class="icon-dashboard-sidebar">
                        @lang('pages.dashboard')
                    </a>
                @endrole
                @role('admin')
                    <a class="sidebar-dashboard-admin" href="{{ route('admin_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/dashboard.png') }}" class="icon-dashboard-sidebar">
                        @lang('pages.dashboard')
                    </a>
                    <a class="sidebar-dashboard-admin" href="{{ route('list_practieces') }}">
                        <i class="fas fa-balance-scale fa-2x"></i>
                        @lang('pages.practieces')
                    </a>
                    <a class="sidebar-dashboard-admin" href="{{ route('list_languages') }}">
                        <i class="bx bx-globe"></i>
                        @lang('pages.languages')

                    </a>
                    <a class="sidebar-dashboard-admin" href="{{ route('list_news') }}">
                        <img src="{{ asset('assets/img/news.png') }}"
                            class="icon-dashboard-sidebar">
                            @lang('pages.news')

                    </a>
                @endrole


                @role('lawyer')
                    <a href="{{ route('list_consultations', base64_encode(Auth()->user()->id)) }}">
                        <img alt="" src="{{ asset('assets/img/consultation-dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                            @lang('pages.consultations')
                    </a>

                    <a href="{{ route('list_cases', base64_encode(Auth()->user()->id)) }}">
                        <i class="fas fa-gavel"></i>
                        @lang('pages.cases')
                    </a>
                @endrole

                @role('admin')
                    <a class="sidebar-dashboard-admin" href="{{ route('list_consultations') }}">
                        <img alt="" src="{{ asset('assets/img/consultation-dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                            @lang('pages.consultations')
                    </a>

                    <a class="sidebar-dashboard-admin" href="{{ route('list_cases') }}">
                        <i class="fas fa-gavel"></i>
                        @lang('pages.cases')
                    </a>

                    <a href="{{ route('list_requests') }}">
                        <img alt="" src="{{ asset('assets/img/template-dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                            @lang('pages.translateFile')

                    </a>
                    <a class="sidebar-dashboard-admin" href="{{ route('list_lawyers') }}">
                        <img alt="" src="{{ asset('assets/img/lawyer_icon.png') }}" class="icon-dashboard-sidebar">
                        @lang('pages.lawyers')

                    </a>

                    <a class="sidebar-dashboard-admin" href="{{ route('list_companies') }}">
                        <img alt="" src="{{ asset('assets/img/translation.png') }}" class="icon-dashboard-sidebar">
                        @lang('pages.companies')
                    </a>

                    <a class="sidebar-dashboard-admin" href="{{ route('list_clients') }}">
                        <i class="fas fa-users"></i>
                        @lang('pages.clients')
                    </a>
                @endrole

                @role('lawyer')
                    <a href="{{ route('list_template') }}">
                        <img alt="" src="{{ asset('assets/img/template-dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                            @lang('pages.templates')
                        </a>
                @endrole
                @role('admin')
                    <a class="sidebar-dashboard-admin" href="{{ route('list_template') }}">
                        <img alt="" src="{{ asset('assets/img/template-dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                            @lang('pages.templates')

                    </a>
                @endrole

                @role('translation_company')
                    <a href="{{ route('list_requests', base64_encode(Auth()->user()->id)) }}">
                        <img alt="" src="{{ asset('assets/img/template-dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                            @lang('pages.translateFile')
                    </a>
                @endrole



                @hasanyrole('lawyer|translation_company')
                    <a href="{{ route('list_general_questions', base64_encode(Auth()->user()->id)) }}">
                        <i class="fas fa-question-circle"></i>
                        @lang('pages.questions')
                    </a>
                @endhasanyrole

                @role('admin')
                    <a class="sidebar-dashboard-admin" href="{{ route('list_admin_general_questions') }}">
                        <i class="fas fa-question-circle"></i>
                        @lang('pages.questions')
                    </a>
                @endrole

                @role('lawyer')
                    <a href="{{ route('chat_lawyer_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/chat-dashboard.png') }}" class="icon-dashboard-sidebar">
                        @lang('pages.chats')
                    </a>
                @endrole

                @role('translation_company')
                    <a href="{{ route('chat_company_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/chat-dashboard.png') }}" class="icon-dashboard-sidebar">
                        @lang('pages.chats')
                    </a>
                @endrole

                @role('admin')
                    <a class="sidebar-dashboard-admin" href="{{ route('chat_lawyer_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/chat-dashboard.png') }}" class="icon-dashboard-sidebar">
                        @lang('pages.chats')
                    </a>
                    <a class="sidebar-dashboard-admin" href="{{ route('list_reviews') }}">
                        <img alt="" src="{{ asset('assets/img/reviews_dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                            @lang('pages.reviews')
                        </a>

                    <a class="sidebar-dashboard-admin" href="{{ route('bills_admin') }}">
                        <img alt="" src="{{ asset('assets/img/invoice.png') }}" class="icon-dashboard-sidebar">
                        @lang('pages.bills')
                    </a>
                    <a class="sidebar-dashboard-admin" href="{{ route('request_to_join') }}">
                        <i class="fas fa-user-plus"></i>
                        @lang('pages.requests_to_join')
                    </a>
                @endrole

                @hasanyrole('lawyer|translation_company')
                    <a href="{{ route('reviews') }}">
                        <img alt="" src="{{ asset('assets/img/reviews_dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                            @lang('pages.reviews')
                    </a>

                    <a href="{{ route('bills_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/invoice.png') }}" class="icon-dashboard-sidebar">
                        @lang('pages.bills')
                    </a>
                @endhasanyrole


            </div>
            <div class="content-dashboard col-lg-9 col-md-1">
                @yield('dashboard')
            </div>
        </div>
    </div>
@endsection
