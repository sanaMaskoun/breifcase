@extends('pages.dashboard.sidebar')
@section('dashboard')


    {{--  <div class="col-lg-9 col-md-12 col-sm-12 ">  --}}
        <div class="sidebar-dashboard">

            <div class="container">
                <div class="row ">
                    <div class="col-12">
                        <p class="p-dash">@lang('pages.revenue'): {{ $revenues }} @lang('pages.AED') <br> @lang('pages.profits'): {{ $profits }} @lang('pages.AED') </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <div>
                                <canvas id="myChartLawyer"></canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="legend mt-3">
                                    <span class="span-1">&#9679;</span> @lang('pages.cases')  {{ $cases }} <br>
                                    <span class="span-2">&#9679; </span>@lang('pages.consultations') {{ $consultations }} <br>
                                    <span class="span-3">&#9679; </span>@lang('pages.questions') {{ $replies }} <br>
                                </div>
                                <a href="{{ route('bills_dashboard') }}" id="billsButton" >@lang('pages.bills')</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-dash mb-4">
                            <div class="card-body">
                                <h5 class="card-title">@lang('pages.analysis_profit')</h5>
                                <canvas id="profitMarginChart" class="canvas"></canvas>
                                <p class="mt-2">@lang('pages.gross_profit'): {{ $percentage_of_profits == 0  ? 0 : 100 - number_format( $percentage_of_profits ,1) }}%<br>@lang('pages.net_profit'): {{ number_format( $percentage_of_profits ,1) }}%</p>
                            </div>

                        </div>
                        <div class=" mb-4 card-dash">
                            <div class="card-body">
                                <h5 class="card-title">@lang('pages.monthly_revenue')</h5>
                                <p>@lang('pages.highest_revenue'):{{ $max_revenue }} ({{ $max_revenue_month }})</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    {{--  </div>  --}}
    <script>
        window.repliesData = @json($replies_data);
        window.casesData = @json($cases_data);
        window.consultationsData = @json($consultations_data);
        var profits = {
            {{--  gross: <?php echo $revenues; ?>,  --}}
            net: <?php echo $percentage_of_profits; ?>,
        };
    </script>
@endsection
