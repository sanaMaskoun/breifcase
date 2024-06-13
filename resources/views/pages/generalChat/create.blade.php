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
                            <h3 class="page-title">@lang('pages.create_general_chat')</h3>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form method="POST" action="{{ route('store_general_chat') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">@lang('pages.general_chat_information') <span></span>
                                        </h5>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>@lang('pages.name') <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" name="name"
                                                placeholder=@lang('pages.enter_name')>
                                            @if ($errors->has('name'))
                                                <span class="errormsg text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="hello-park">
                                        <h4>@lang('pages.choose_role')</h4>
                                        <select name="role" id="role" class="form-control">
                                            <option value=""></option>
                                            <option value="1" {{ request('role') == '1' ? 'selected' : '' }}>
                                                @lang('EnumFile.Lawyer')</option>
                                            <option value="2" {{ request('role') == '2' ? 'selected' : '' }}>
                                                @lang('EnumFile.translator')</option>
                                        </select>
                                        @if ($errors->has('role'))
                                            <span class="errormsg text-danger">{{ $errors->first('role') }}</span>
                                        @endif
                                    </div>



                                    <div class="hello-park">
                                        <h4>@lang('pages.choose_members')</h4>
                                        <div class="educate-year">
                                            <div class="follow-btn-group">
                                                @foreach ($members as $member)
                                                    <label style="padding-left: 10px">
                                                        <input type="checkbox" name="members[]" value="{{ $member->id }}"
                                                            class="member-checkbox">
                                                        <img class="rounded-circle img_members"
                                                            src="{{ asset($member->getFirstMediaUrl('profileUser')) }}"
                                                            alt="User Image"> <span> {{ $member->name }} </span>
                                                    </label><br><br>
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
