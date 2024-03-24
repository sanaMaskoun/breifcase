@extends('layouts.app')

@section('content')

    <body class="bg-light-gray" id="body">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
            <div class="d-flex flex-column justify-content-between">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <div class="card card-default mb-0">
                            <div class="card-header pb-0">
                                <div class="app-brand w-100 d-flex justify-content-center border-bottom-0">
                                    <a class="w-auto pl-0" href="#">
                                        <img src="images/logo.png" alt="breifcase">
                                        <span class="brand-name text-dark">breifcase</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body px-5 pb-5 pt-0">

                                <h4 class="text-dark mb-6 text-center">Sign in </h4>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="email" class="form-control input-lg" id="email" name="email" aria-describedby="emailHelp" placeholder="email">
                                        </div>

                                        <div class="form-group col-md-12 ">
                                            <input type="password" class="form-control input-lg" id="password" name="password"  placeholder="Password">
                                        </div>
                                        <div class="col-md-12">

                                            <div class="d-flex justify-content-between mb-3">
                                        </div>

                                            <button type="submit" class="btn btn-primary btn-pill mb-4">Sign In</button>

                                            <p>Do not have an account yet ?
                                                <a class="text-blue" href="{{ route('register') }}">Sign Up</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
@endsection
