@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Dashboard</h3>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">

                <div class="col-xl-4 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6> <i class="far fa-question-circle icon-dashboard"></i></i>
                                        General Questions</h6>
                                    <h3>{{ $replies }}</h3>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6> <i class="fas fa-gavel icon-dashboard"></i>
                                        Practices</h6>
                                    <h3>{{ $practices }}</h3>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12 d-flex">
                    <div class="card bg-comman w-100">
                        <div class="card-body">
                            <div class="db-widgets d-flex justify-content-between align-items-center">
                                <div class="db-info">
                                    <h6> <i class="fas fa-balance-scale icon-dashboard"></i>
                                        Consultations</h6>
                                    <h3>{{ $consultations }}</h3>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 col-lg-6">

                    <div class="card card-chart">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Profits</h5>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div id="apexcharts-area-lawyer"></div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 col-lg-6">

                    <div class="card card-chart">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title">Number of Clients</h5>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div id="bar-lawyer"></div>
                        </div>
                    </div>

                </div>
            </div>



        </div>

    </div>
@endsection
