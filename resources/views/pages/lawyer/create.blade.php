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
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">@lang('pages.add_lawyer')</h3>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store_lawyer') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">@lang('pages.lawyer_information') <span><a
                                                    href="javascript:;"><i class="feather-more-vertical"></i></a></span>
                                        </h5>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>@lang('pages.name') <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" name="name"
                                                placeholder="Enter Name">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label> @lang('pages.email') <span class="login-danger">*</span></label>
                                            <input class="form-control" type="email" name="email"
                                                placeholder="Enter email">
                                        </div>
                                    </div>

                                    {{--  <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select class="form-control select">
                                                <option>Select Gender</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                        </div>
                                    </div>
  --}}


                                    {{--  <div class="col-12 col-sm-4">
                                    <div class="form-group students-up-files">
                                        <label>Upload Student Photo (150px X 150px)</label>
                                        <div class="uplod">
                                            <label class="file-upload image-upbtn mb-0">
                                                Choose File <input type="file">
                                            </label>
                                        </div>
                                    </div>
                                </div>  --}}

                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary"> @lang('pages.save') </button>
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
