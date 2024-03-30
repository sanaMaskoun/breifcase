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
                        <h3 class="page-title">List Practices</h3>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('list_practieces') }}">
                <div class="page-sub-header" style="margin-bottom: 15px; width: 20rem;">
                    <input type="text" name="name" class="form-control" placeholder="Search here">
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
                                        <h3 class="page-title">Practices</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">

                                        <a href="{{ route('add_practiece') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Name</th>
                                            <th>description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($practices as $practice)
                                            <tr>
                                                <td>{{ $practice->name }}</td>
                                                <td>{{ $practice->description }}</td>
                                                <td>
                                                    <a href="{{ route('edit_practiece', $practice->id) }}"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
