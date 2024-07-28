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
                    <div class="col-lg-3 col-md-6 col-sm-12  mt-4">
                        <a class="title-details text-center" href="{{ route('show_general_question', base64_encode($question->id)) }}">
                             <img src="{{ asset('assets/img/generalQuestion.png') }}" alt="question Image" class="icon-dasbboard-admin">
                            <h5 class="title-document-dashboard">{{ $question->title }}</h5>
                        </a>
                        <div class="container-details-document-dashboard">
                            {{--  <p class="details-document-dashboard">{{ $question->user->name }}</p>  --}}
                            <p class="text-center details-document-dashboard">{{ $question->created_at->format('Y/m/d') }}</p>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    {{--  </div>  --}}
@endsection
