@extends('master.app')
@section('content')

        <div class="container">
            <div class="row container-box-thank-you ">
            <div class="box-thank-you">
                <div class="col-12  d-flex">
                    <img src="{{ asset('assets/img/reply_general_question.png') }}" class="img-q" alt="">
                    <h2 class="h2">@lang('pages.questions')</h2>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 text-center black-1">
                    <h2>@lang('pages.posed_answer')</h2>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12  img-thank-you">
                    <img src="{{ asset('assets/img/thank_you.png') }}" alt="" class="img-fluid ">
                </div>
            </div>


            </div>
        </div>

@endsection
