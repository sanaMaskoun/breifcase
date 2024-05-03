@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">



            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">@lang('pages.list_suggestions')</h3>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">@lang('pages.suggestion')</h3>
                                    </div>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0  table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>@lang('pages.title')</th>
                                            <th>@lang('pages.description')</th>
                                            <th>@lang('pages.client')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suggestions as $suggestion)
                                            @php
                                                $encodedId = base64_encode($suggestion->user->id);
                                            @endphp
                                            <tr>
                                                <td>{{ $suggestion->title }}</td>
                                                <td>{{ $suggestion->description }}</td>
                                                <td> <a href="{{ route('show_client', $encodedId) }}">
                                                        {{ $suggestion->user->name }}
                                                    </a></td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                <div class="pagination">
                                    <span class="page-info">@lang('pagination.pages') {{ $suggestions->currentPage() }}
                                        @lang('pagination.of')
                                        {{ $suggestions->lastPage() }}</span>
                                    <a href="{{ $suggestions->previousPageUrl() }}" class="prev"
                                        @if (!$suggestions->previousPageUrl()) disabled @endif>@lang('pagination.previous')</a>
                                    <a href="{{ $suggestions->nextPageUrl() }}" class="next"
                                        @if (!$suggestions->nextPageUrl()) disabled @endif>@lang('pagination.next')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
