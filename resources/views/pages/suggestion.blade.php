@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">



            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">List Suggestions</h3>
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
                                        <h3 class="page-title">Suggestion</h3>
                                    </div>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0  table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Client</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suggestions as $suggestion)
                                            <tr>
                                                <td>{{ $suggestion->title }}</td>
                                                <td>{{ $suggestion->description }}</td>
                                                <td>  <a href="{{ route('show_client', $suggestion->user->id) }}">
                                                   {{ $suggestion->user->name }}
                                                </a></td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
