@extends('master.app')
@section('content')
        {{--  <div class="content">  --}}

            <div class="case-details-content ml-3">
                <h6>@lang('pages.title'): <span>{{ $news->title }}</span></h6>
                <h6>@lang('pages.short_description'): {{ $news->short_description }}</h6>
                    <img src="{{ $news->getFirstMediaUrl('news') }}" class="clickable case-details-content-img">

                <h6>@lang('pages.description'): {{ $news->description }}</h6>



            </div>


        {{--  </div>  --}}
@endsection