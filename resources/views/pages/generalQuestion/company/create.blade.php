@extends('pages.dashboard.sidebar')
@section('dashboard')


<div class="col-lg-9 col-md-1">
    <div class="content ">
        <div class="header-documents-dashboard">
            <h2>General Questions</h2>

        </div>
        <form action="{{ route('save_general_question') }}" method="POST">
            @csrf
            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center container-title-company">
                <input type="text" name="title" class="title-post-company" placeholder="Title">
                @error('title')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                <p class="paragraph-post-company">
                    Type your General question here
                </p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-Questions">
                <textarea name="question" placeholder=" write Questions"></textarea>
                @error('question')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <p class="paragraph-2-post-company">
                YOUR NAME WILL NOT SHOW IN THE GQ <br>PAGE YOUR QUESTION MAY OR MAY
                NOT BE ANSWERED
            </p>

            <div class="col-md-12 d-flex justify-content-center">
                <button type="submit" class="btn-post-comapny">Post </button>
            </div>
        </form>
    </div>
</div>


@endsection
