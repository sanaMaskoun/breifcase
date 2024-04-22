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
                            <h3 class="page-title">create group</h3>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store_group') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Group information <span></span>
                                        </h5>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Name <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" name="name"
                                                placeholder="Enter Name">
                                        </div>
                                    </div>



                                    <div class="hello-park">
                                        <h4>choose members</h4>

                                        <div class="educate-year">
                                            <div class="follow-btn-group">
                                                @foreach ($members as $member)
                                                    <label  style="padding-left: 10px">
                                                        <input type="checkbox" name="members[]" value="{{ $member->id }}">
                                                          <img class="rounded-circle img_members" src="{{ asset($member->getFirstMediaUrl('profileUser')) }}"
                                                          alt="User Image"> <span> {{ $member->name }} </span> </label><br><br>
                                                @endforeach
                                                @if ($errors->has('members'))
                                                    <span
                                                        class="errormsg text-danger">{{ $errors->first('members') }}</span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary"> save </button>
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
