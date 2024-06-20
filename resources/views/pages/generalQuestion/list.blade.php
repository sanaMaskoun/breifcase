@extends('master.app')
@section('content')
<div class="box1">
    <div class="container continer_1">
        <div class="row">
            <div class="col-12 d-flex">
                <img src="{{ asset('assets/img/Full_Website_-_LAWYER_V1__2_-removebg-preview.png') }}" class="logo_general_question" alt="">
                <h2 class="title_general_question">General Questions</h2>
              </div>
            {{--  <div class="col-12">
                <img src="img/Full_Website_-_LAWYER_V1__2_-removebg-preview.png" class="img-q" alt="">

                <h2 class="title_question">General Questions</h2>
            </div>  --}}
            @foreach ($questions as  $question)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="profile-card_1">
                    <img src="{{ $question->user->getFirstMediaUrl('profile') }}" alt="Profile" />
                    <p>{{ $question->user->name }}</p>
                    <p>{{ $question->title }}</p>
                </div>
            </div>
            @endforeach


        </div>
    </div>
</div>

@endsection
