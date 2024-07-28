@extends('pages.client.show')

@section('profile_content')
    <div class="box-profile-1 ">
        <div class="details">
            @foreach ($questions as $question)
                <div class="col-lg-4 col-md-6 col-sm-12 mt-3 consultation-card">
                    <a href="{{ route('show_client_general_question' , base64_encode($question->id)) }}">
                        <img src="{{ asset('assets/img/generalQuestion.png') }}" alt="general question Image" class="img-doc">
                    </a>
                    <p>{{ $question->title }}</p>
                </div>
            @endforeach
        </div>
        <form action="{{ route('create_general_question') }}" method="GET">
            @csrf
            <div class="col-md-12 ">
                <button type="submit" class="btn_post_general_question">@lang('pages.post_question')</button>
            </div>
        </form>
    </div>
@endsection
