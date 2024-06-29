@extends('master.app')
@section('content')

<div class="box-reply-question">
    <div class="container">
        <div class="row ">
            <div class="col-12 d-flex">
                <img src="{{ asset('assets/img/reply_general_question.png') }}" class="img-q" alt="">
                <h2 class="h2">General Questions</h2>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 box-text ">

                <label for="questionTitle">TITLE OF THE QUESTION</label>
                <textarea class="form-control textarea-1" id="questionTitle"
                    placeholder="Write the title of the question here..." readonly></textarea>

            </div>
            <div class="col-lg-6 col-md-12 col-sm-12  box-text">

                <label for="questionAnswer">ANSWER THE QUESTION</label>
                <textarea class="form-control textarea-1" id="questionAnswer"
                    placeholder="Write the answer here..."></textarea>

                <button type="submit" class="btn1 btn2 ">Post</button>

            </div>




        </div>
    </div>

</div>

@endsection
