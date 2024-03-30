@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif


            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Practice</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update_practiece',$practice->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span> Practice Information</span></h5>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label> name <span class="login-danger">*</span></label>
                                            <input type="text" name="name"  value="{{ $practice->name }}" class="form-control">
                                            @error('name')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label> Description <span class="login-danger">*</span></label>
                                            <input type="text" name="description" value="{{ $practice->description }}" class="form-control">
                                            @error('description')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror   
                                        </div>

                                    </div>


                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
