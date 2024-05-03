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
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">@lang('pages.list_Practice')</h3>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('list_practieces') }}">
                <div class="page-sub-header" style="margin-bottom: 15px; width: 20rem;">
                    <input type="text" name="name" class="form-control" placeholder=@lang('pages.search')>
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>


            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">@lang('pages.practiece')</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">

                                        <a href="{{ route('add_practiece') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0  table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>@lang('pages.name')</th>
                                            <th>@lang('pages.description')</th>
                                            <th>@lang('pages.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($practices as $practice)
                                            @php
                                                $encodedId = base64_encode($practice->id);
                                            @endphp
                                            <tr>
                                                <td>{{ $practice->name }}</td>
                                                <td>{{ $practice->description }}</td>
                                                <td>
                                                    <a href="{{ route('edit_practiece', $encodedId) }}"
                                                        class="btn btn-sm bg-danger-light">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <a href="{{ route('delete_practiece', $practice->id) }}"
                                                        class="btn btn-sm bg-danger-light">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>


                            </div>
                            <div class="pagination">
                                <span class="page-info">@lang('pagination.pages') {{ $practices->currentPage() }} @lang('pagination.of')
                                    {{ $practices->lastPage() }}</span>
                                <a href="{{ $practices->previousPageUrl() }}" class="prev"
                                    @if (!$practices->previousPageUrl()) disabled @endif>@lang('pagination.previous')</a>
                                <a href="{{ $practices->nextPageUrl() }}" class="next"
                                    @if (!$practices->nextPageUrl()) disabled @endif>@lang('pagination.next')</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
