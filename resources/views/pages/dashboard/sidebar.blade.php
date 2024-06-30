@extends('master.app')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-lg-3 col-md-12 col-sm-12 sidebar-dashboard ">
                <a href="{{ route('lawyer_dashboard') }}">
                    <img alt="" src="{{ asset('assets/img/dashboard.png') }}" class="icon-dashboard-sidebar">
                    Dashboard
                </a>

                @hasanyrole('lawyer|translation_company')
                    <a href="{{ route('list_consultations', base64_encode(Auth()->user()->id)) }}">
                        <img alt="" src="{{ asset('assets/img/consultation-dashboard.png') }}" class="icon-dashboard-sidebar">
                        Consultations
                    </a>

                    <a href="{{ route('list_cases', base64_encode(Auth()->user()->id)) }}">
                        <i class="fas fa-gavel"></i>
                        Cases
                    </a>
                @endhasanyrole

                @role('admin')
                    <a href="{{ route('list_consultations') }}">
                        <img alt="" src="{{ asset('assets/img/consultation-dashboard.png') }}" class="icon-dashboard-sidebar">
                        Consultations
                    </a>

                    <a href="{{ route('list_cases') }}">
                        <i class="fas fa-gavel"></i>
                        Cases
                    </a>
                @endrole

                <a href="{{ route('list_template') }}">
                    <img alt="" src="{{ asset('assets/img/template-dashboard.png') }}" class="icon-dashboard-sidebar">
                    Templates
                </a>


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


                <a href="{{ route('chat_dashboard') }}">
                    <img alt="" src="{{ asset('assets/img/chat-dashboard.png') }}" class="icon-dashboard-sidebar">
                    Chat
                </a>

                <a href="{{ route('reviews') }}">
                    <img alt="" src="{{ asset('assets/img/reviews_dashboard.png') }}" class="icon-dashboard-sidebar">
                    Reviews
                </a>

                <a href="#">
                    <i class="fas fa-chart-bar"></i>
                    Statistics
                </a>

            </div>

            @yield('dashboard')
        </div>
    </div>
@endsection
