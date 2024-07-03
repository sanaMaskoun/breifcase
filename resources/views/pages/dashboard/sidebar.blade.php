@extends('master.app')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-lg-3 col-md-12 col-sm-12 sidebar-dashboard ">

                @role('lawyer')
                    <a href="{{ route('lawyer_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/dashboard.png') }}" class="icon-dashboard-sidebar">
                        Dashboard
                    </a>
                @endrole
                @role('translation_company')
                    <a href="{{ route('company_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/dashboard.png') }}" class="icon-dashboard-sidebar">
                        Dashboard
                    </a>
                @endrole


                @role('lawyer')
                    <a href="{{ route('list_consultations', base64_encode(Auth()->user()->id)) }}">
                        <img alt="" src="{{ asset('assets/img/consultation-dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                        Consultations
                    </a>

                    <a href="{{ route('list_cases', base64_encode(Auth()->user()->id)) }}">
                        <i class="fas fa-gavel"></i>
                        Cases
                    </a>
                @endrole

                @role('admin')
                    <a href="{{ route('list_consultations') }}">
                        <img alt="" src="{{ asset('assets/img/consultation-dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                        Consultations
                    </a>

                    <a href="{{ route('list_cases') }}">
                        <i class="fas fa-gavel"></i>
                        Cases
                    </a>
                @endrole

                @hasanyrole('lawyer|admin')
                    <a href="{{ route('list_template') }}">
                        <img alt="" src="{{ asset('assets/img/template-dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                        Templates
                    </a>
                @endhasanyrole

                @role('translation_company')
                    <a href="{{ route('list_requests', base64_encode(Auth()->user()->id)) }}">
                        <img alt="" src="{{ asset('assets/img/template-dashboard.png') }}"
                            class="icon-dashboard-sidebar">
                        Requests
                    </a>
                @endrole



                @hasanyrole('lawyer|translation_company')
                    <a href="{{ route('list_general_questions', base64_encode(Auth()->user()->id)) }}">
                        <i class="fas fa-question-circle"></i>
                        General Questions
                    </a>
                @endhasanyrole

                @role('admin')
                    <a href="{{ route('list_general_questions') }}">
                        <i class="fas fa-question-circle"></i>
                        General Questions
                    </a>
                @endrole

                @role('lawyer')
                    <a href="{{ route('chat_lawyer_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/chat-dashboard.png') }}" class="icon-dashboard-sidebar">
                        Chat
                    </a>
                @endrole

                @role('translation_company')
                    <a href="{{ route('chat_company_dashboard') }}">
                        <img alt="" src="{{ asset('assets/img/chat-dashboard.png') }}" class="icon-dashboard-sidebar">
                        Chat
                    </a>
                @endrole
                <a href="{{ route('reviews') }}">
                    <img alt="" src="{{ asset('assets/img/reviews_dashboard.png') }}"
                        class="icon-dashboard-sidebar">
                    Reviews
                </a>

                <a href="{{ route('bills_dashbord') }}">
                    <img alt="" src="{{ asset('assets/img/invoice.png') }}" class="icon-dashboard-sidebar">
                    Bills and Receipts
                </a>



            </div>

            @yield('dashboard')
        </div>
    </div>
@endsection
