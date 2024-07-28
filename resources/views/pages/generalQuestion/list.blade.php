@extends('master.app')
@section('content')
    <div class="container box1 box-general-questions">
        <div class="row">
            <div class="col-12 d-flex">
                <img src="{{ asset('assets/img/reply_general_question.png') }}" class="logo_general_question" alt="">
                <h2 class="title_general_question">@lang('pages.questions')</h2>
            </div>

            @foreach ($questions as $question)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="profile-card_1">

                        @hasanyrole('lawyer')
                            <a href="{{ route('reply_general_question', base64_encode($question->id)) }}"
                                class="link-reply-question">
                            @endhasanyrole
                            <img src="{{ $question->user->getFirstMediaUrl('profile') }}" alt="Profile" />
                            {{--  <p>{{ $question->user->name }}</p>  --}}
                            <p>{{ $question->title }}</p>
                            @hasanyrole('lawyer')
                            </a>
                        @endhasanyrole

                        {{--  @role('client')  --}}
                        {{--  <img src="{{ $question->user->getFirstMediaUrl('profile') }}" alt="Profile" />
                        <p>{{ $question->user->name }}</p>
                        <p>{{ $question->title }}</p>  --}}
                        {{--  @endrole  --}}

                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection
