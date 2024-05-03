@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            @if ($message = Session::get('success'))
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                </div>
            @endif

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">@lang('pages.list_clients')</h3>

                        </div>

                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('list_clients') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{--  <label for="name">@lang('pages.name')</label>  --}}
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder=@lang('pages.search') value="{{ request('name') }}">

                                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>




            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body pb-0">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">@lang('pages.client')</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="student-pro-list">
                                <div class="row">
                                    @foreach ($clients as $client)
                                        @php
                                            $encodedId = base64_encode($client->id);
                                        @endphp
                                        <div class="col-xl-3 col-lg-4 col-md-6 d-flex">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="student-box flex-fill">
                                                        <div class="student-img">
                                                            <a href="{{ route('show_client', $encodedId) }}">
                                                                <img class="img-fluid w-50"
                                                                    src="{{ asset($client->getFirstMediaUrl('profileUser')) }}">
                                                            </a>
                                                        </div>
                                                        <div class="student-content pb-0">
                                                            <h5><a
                                                                    href="{{ route('show_client', $encodedId) }}">{{ $client->name }}</a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="pagination">
                                        <span class="page-info">@lang('pagination.pages') {{ $clients->currentPage() }} @lang('pagination.of')
                                            {{ $clients->lastPage() }}</span>
                                        <a href="{{ $clients->previousPageUrl() }}" class="prev"
                                            @if (!$clients->previousPageUrl()) disabled @endif>@lang('pagination.previous')</a>
                                        <a href="{{ $clients->nextPageUrl() }}" class="next"
                                            @if (!$clients->nextPageUrl()) disabled @endif>@lang('pagination.next')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
