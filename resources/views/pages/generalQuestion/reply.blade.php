@extends('master.app')
@section('content')
    <div class="box-reply-question">
        <div class="container">
            <div class="row ">
                <div class="col-12 d-flex">
                    <img src="{{ asset('assets/img/reply_general_question.png') }}" class="img-q" alt="">
                    <h2 class="h2">@lang('pages.questions')</h2>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12 box-text ">

                    <p class="title-reply-general-question">{{ $question->title }}</p>
                    <p class="description-reply-general-question">{{ $question->question }}</p>

                </div>


                <div class="col-lg-6 col-md-12 col-sm-12  box-text">
                    <form method="POST" action="{{ route('store_reply_general_question', $question->id) }}">
                        @csrf
                        <label class="answer-general-question" for="questionAnswer">@lang('pages.answer_question')</label>
                        <textarea class="form-control reply-general-question" id="questionAnswer" name="reply"
                            placeholder="@lang('pages.write_answer')"></textarea>
                        @error('reply')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <div class="container-btn-posr-reply">
                            <button type="submit" class="btn-post-reply ">@lang('pages.btn_post')</button>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
