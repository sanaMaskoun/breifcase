@extends('pages.dashboard.sidebar')
@section('dashboard')


{{--  <div class="col-lg-9 col-md-1">  --}}
    <div class="content ">
        <div class="header-documents-dashboard">
            <h2>@lang('pages.questions')</h2>

        </div>
        <form action="{{ route('save_general_question') }}" method="POST">
            @csrf
            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center container-title-company">
                <input type="text" name="title" class="title-post-company" placeholder="@lang('pages.title')">
                @error('title')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                <p class="paragraph-post-company">
                    @lang('pages.title_write_question')
                </p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-Questions">
                <textarea name="question" placeholder="@lang('pages.write_question')"></textarea>
                @error('question')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            <p class="paragraph-2-post-company">
                @lang('pages.first_description') <br> @lang('pages.second_description')
            </p>

            <div class="col-md-12 d-flex justify-content-center">
                <button type="submit" class="btn-post-comapny">@lang('pages.btn_post') </button>
            </div>
        </form>
    </div>
{{--  </div>  --}}


@endsection
