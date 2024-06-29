@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>General Questions</h2>
                <span class="num-document">Total {{ $num_questions }} </span>

            </div>

            <div class="list-document-dashboard">
                @foreach ($questions as $question)
                    <div class="col-lg-3 col-md-6 col-sm-12 ">
                        <img src="{{ asset('assets/img/generalQuestion.png') }}" alt="question Image" class="img-doc">
                        <h5 class="title-document-dashboard">{{ $question->title }}</h5>
                        <div class="container-details-document-dashboard">
                            <p class="details-document-dashboard">{{ $question->created_at->format('Y/m/d') }}</p>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
