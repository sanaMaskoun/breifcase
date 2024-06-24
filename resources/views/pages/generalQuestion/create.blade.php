@extends('pages.client.details')

@section('profile_content')
    <div class="box-profile-post">
        <form action="{{ route('save_general_question') }}" method="POST">
            @csrf
            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                <input type="text" name="title" class="title-post" placeholder="Title">
                @error('title')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                <p class="p-Questions">
                    Type your General question here
                </p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-Questions">
                <textarea name="question" placeholder=" write Questions"></textarea>
                @error('question')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <p class="link-Questions">
                YOUR NAME WILL NOT SHOW IN THE GQ <br>PAGE YOUR QUESTION MAY OR MAY
                NOT BE ANSWERED
            </p>

            <div class="col-md-12 d-flex justify-content-center btn">
                <button type="submit" class="btn1">Post </button>
            </div>
    </div>
    </form>
@endsection
