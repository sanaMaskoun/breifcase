@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
    <div class="content">
        <div class="header-documents-dashboard">
            <h2>@lang('pages.suggestions') </h2>
            <span class="num-documents">@lang('pages.total') {{ $num_suggestions }} </span>

        </div>

        <div class="list-document-dashboard suggestion-page">
            @foreach ($suggestions as $suggestion)
                <div class="col-lg-3 col-md-6 col-sm-12  mt-4">
                    <div class="row">
                        <div class="col-md-3 img-suggestion">
                            <img src="{{ $suggestion->user->getFirstMediaUrl('profile') }}" alt="user Image"
                                class="img-user-suggestion">

                        </div>
                        <div class="col-md-9">
                            <a href="{{ route('show_suggestion', base64_encode($suggestion->id)) }}"
                                class="title-suggestion">
                                <h5 class="title-document-dashboard">{{ $suggestion->title }}</h5>
                            </a>
                            <div class="container-details-document-dashboard">
                                <p class="details-document-dashboard">{{ $suggestion->user->name }}</p>
                                <p class="details-document-dashboard">{{ $suggestion->created_at->format('Y/m/d') }}</p>
                            </div>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>

    </div>
    {{--  </div>  --}}
@endsection
