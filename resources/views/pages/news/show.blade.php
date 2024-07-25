@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content">

            <div class="case-details-content ml-3">
                <h6>Title: <span>{{ $news->title }}</span></h6>
                <h6>Short description: {{ $news->short_description }}</h6>
                    <img src="{{ $news->getFirstMediaUrl('news') }}" class="clickable case-details-content-img">

                <h6>Description: {{ $news->description }}</h6>



            </div>


        </div>
    </div>
@endsection
