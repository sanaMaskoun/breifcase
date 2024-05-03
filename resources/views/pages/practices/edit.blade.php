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
                        <h3 class="page-title">@lang('pages.edit_Practice')</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('update_practiece',$decodedId) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span> @lang('pages.practice_information')</span></h5>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label> @lang('pages.name') <span class="login-danger">*</span></label>
                                            <input type="text" name="name"  value="{{ $practice->name }}" class="form-control">
                                            @error('name')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label> @lang('pages.description') <span class="login-danger">*</span></label>
                                            <input type="text" name="description" value="{{ $practice->description }}" class="form-control">
                                            @error('description')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">@lang('pages.save')</button>
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
