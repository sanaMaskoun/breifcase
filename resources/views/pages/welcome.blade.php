@extends('master.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 content-box-welcome" >
                <div class="box_welcome">
                    <img src="{{ asset('assets/img/welcome.png') }}" alt="" class="img-welcome img-fluid" />
                    <p class="welcome-phrase-1">@lang('pages.our_community')</p>
                    <p class="welcome-phrase-2">@lang('pages.recieve_email')</p>
                </div>
            </div>
        </div>
    </div>
@endsection
