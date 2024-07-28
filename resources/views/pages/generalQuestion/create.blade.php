@extends('pages.client.show')

@section('profile_content')
    <div class="box-profile-post">
        <form action="{{ route('save_general_question') }}" method="POST">
            @csrf
            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                <input type="text" name="title" class="title-post" placeholder="@lang('pages.title')">
                @error('title')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                <p class="p-Questions">
                    @lang('pages.title_write_question')
                            </p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-Questions">
                <textarea name="question" placeholder=" @lang('pages.write_question')"></textarea>
                @error('question')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <p class="link-Questions">
                @lang('pages.first_description') <br> @lang('pages.second_description')

            </p>

            <div class="col-md-12 d-flex justify-content-center btn">
                <button type="submit" class="btn1">@lang('pages.btn_post') </button>
            </div>
        </form>
    </div>
@endsection
