@extends('layouts.app')

@section('content')

    <body class="bg-light-gray" id="body">
        <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh">
            <div class="d-flex flex-column justify-content-between">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-xl-5 col-md-10 ">
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
                                <h4 class="text-dark text-center mb-5">Sign Up</h4>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="text" class="form-control input-lg" id="name"
                                                name="name" aria-describedby="nameHelp" placeholder="Name">
                                        </div>
                                        <div class="form-group col-md-12 mb-4">
                                            <input type="email" class="form-control input-lg" id="email"
                                                name="email" aria-describedby="emailHelp" placeholder="Username">
                                        </div>
                                        
                                        <div class="form-group col-md-12 ">
                                            <input type="password" class="form-control input-lg" id="password"
                                                name="password" placeholder="Password">
                                        </div>

                                        <div class="form-group col-md-12 ">
                                            <input type="password" class="form-control input-lg" id="cpassword"
                                                name="email" placeholder="Confirm Password">
                                        </div>

                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-pill mb-4">Sign Up</button>

                                            <p>Already have an account?
                                                <a class="text-blue" href="{{ route('login') }}">Sign in</a>
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
