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
                            <h3 class="page-title">List Lawyers</h3>

                        </div>

                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('list_clients') }}">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control"
                                    placeholder="Search here" value="{{ request('name') }}">

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
                                        <h3 class="page-title">clients</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="student-pro-list">
                                <div class="row">
                                    @foreach ($clients as $client)
                                        <div class="col-xl-3 col-lg-4 col-md-6 d-flex">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="student-box flex-fill">
                                                        <div class="student-img">
                                                            <a href="{{ route('show_client', $client->id) }}">
                                                                <img class="img-fluid" alt="Students Info"
                                                                    src="{{ asset($client->getFirstMediaUrl('profileUser')) }}">
                                                            </a>
                                                        </div>
                                                        <div class="student-content pb-0">
                                                            <h5><a
                                                                    href="{{ route('show_client', $client->id) }}">{{ $client->name }}</a>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
