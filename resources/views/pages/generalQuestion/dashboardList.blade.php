@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>@lang('pages.questions')</h2>
                <span class="num-document">@lang('pages.total') {{ $num_questions }} </span>

            </div>

            <div class="list-document-dashboard">
                @foreach ($questions as $question)
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-4">
                        <a class="title-details text-center" href="{{ route('show_general_question', base64_encode($question->id)) }}">

                        <img src="{{ asset('assets/img/generalQuestion.png') }}" alt="question Image" class="img-doc">
                        <h5 class="title-document-dashboard">{{ $question->title }}</h5>
                        <div class="container-details-document-dashboard">
                            <p class="details-document-dashboard">{{ $question->created_at->format('Y/m/d') }}</p>
                        </div>
                        </a>


                    </div>
                @endforeach
            </div>
            @role('translation_company')
            <div class="d-flex justify-content-end">
                <a href="{{ route('create_general_question') }}" class="btn-post-GQ-company">@lang('pages.post_question')</a>
            </div>
            @endrole
        </div>
    {{--  </div>  --}}
@endsection
