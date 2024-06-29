@extends('master.app')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-lg-3 col-md-2 sidebar-dashboard ">
            <a href="{{ route('lawyer_dashboard') }}"><i class="fas fa-th-large"></i>Dashboard</a>

            @hasanyrole('lawyer|translation_company')
              <a href="{{ route('list_consultations' , base64_encode(Auth()->user()->id) ) }}"><i class="fas fa-file-medical-alt"></i>Consultations</a>
              <a href="{{ route('list_cases' , base64_encode(Auth()->user()->id)) }}"><i class="fas fa-gavel"></i>Cases</a>

            @endhasanyrole

            @role('admin')
              <a href="{{ route('list_consultations') }}"><i class="fas fa-file-medical-alt"></i>Consultations</a>
              <a href="{{ route('list_cases') }}"><i class="fas fa-gavel"></i>Cases</a>

            @endrole

            <a href="{{ route('list_template') }}"><i class="fas fa-file-alt"></i>Templates</a>


            @hasanyrole('lawyer|translation_company')
            <a href="{{ route('list_general_questions' , base64_encode(Auth()->user()->id)) }}"><i class="fas fa-question-circle"></i>General Questions</a>
            @endhasanyrole

            @role('admin')
            <a href="{{ route('list_general_questions') }}"><i class="fas fa-question-circle"></i>General Questions</a>
            @endrole


            <a href="#"><i class="fas fa-comments"></i>Chat</a>
            <a href="#"><i class="fas fa-star"></i>Reviews</a>
            <a href="#"><i class="fas fa-chart-bar"></i>Statistics</a>
        </div>

       @yield('dashboard')
    </div>
</div>
@endsection
