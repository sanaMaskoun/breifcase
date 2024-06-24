@extends('master.app')

@section('content')
    <div>
        <div class="row">
            @if (Session::has('error'))
                <div class="alert alert-danger text-center" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="col-lg-6 col-md-6 col-sm-12">

                <h2 class="text_7">Welcome to our community</h2>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 ">
                <div class="box_1">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 form-group-Sign">
                                    <label for="email">Email:</label>
                                    <div class="input-group form_login">
                                        <input type="email" id="email" name="email" class="form-control" />
                                        <div class="input-group-append">
                                            <span>
                                                <i class="fas fa-user-circle"></i> </span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 form-group-Sign">
                                    <label for="password">Password:</label>
                                    <div class="input-group form_login">
                                        <input type="password" id="password" name="password" class="form-control" />
                                        <div class="input-group-append">
                                            <span class="toggle-password" style="cursor: pointer;">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>

                                    @error('password')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn1 btn_login">Log In</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection