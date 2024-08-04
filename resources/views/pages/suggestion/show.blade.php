@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
    <div class="content">
        <div class="header-documents-dashboard">
            <h2>@lang('pages.suggestions') </h2>

        </div>

        <div class="list-document-dashboard">

            <div class=" col-md-4 mt-5">
                <img alt="" src="{{ $suggestion->user->getFirstMediaUrl('profile') }}"
                    class="img-user-suggestion-details">
                <p class="name-user-suggestion"> {{ $suggestion->user->name }}</p>
            </div>
            <div class=" col-md-8  mt-5  body-suggestion">
                <p class="name-user-suggestion"> {{ $suggestion->title }}</p>
                <p class="description-suggestion"> {{ $suggestion->description }} </p>
                <span class="d-flex justify-content-start">{{ $suggestion->created_at->format('Y/m/d') }}</span>
            </div>

        </div>

    </div>
    {{--  </div>  --}}
@endsection
