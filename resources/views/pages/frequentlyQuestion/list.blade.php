@extends('master.app')
@section('content')
<div class="container box1 box-general-questions">
        <div class="row">
            <div class="col-12 d-flex">
                <img src="{{ asset('assets/img/FAQ.png') }}" class="img_1" alt="">
                <h2 class="title_general_question">Frequently Questions</h2>
            </div>
            @foreach ($frequently_questions as  $frequently_question)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="profile-card_1">
                    <img src="{{ $frequently_question->user->getFirstMediaUrl('profile') }}" alt="Profile" />
                    <p>{{ $frequently_question->user->name }}</p>
                    <p>{{ $frequently_question->title }}</p>
                </div>
            </div>
            @endforeach


        </div>
</div>

@endsection
