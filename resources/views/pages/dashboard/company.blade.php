@extends('pages.dashboard.sidebar')
@section('dashboard')


    <div class="col-lg-9 col-md-12 col-sm-12 ">
        <div class="sidebar-dashboard">

            <div class="container">
                <div class="row ">
                    <div class="col-12">
                        <p class="p-dash">Revenue: {{ $revenues }} AED <br> Profit: {{ $profits }} AED</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <div>
                                <canvas id="myChartCompany"></canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="legend mt-3">
                                    <span class="span-2">&#9679; </span>clients {{ $num_clients }} <br>
                                </div>
                                <a href="{{ route('bills_dashboard') }}" id="billsButton" >Bills and Receipts</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-dash mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Profit Margin Analysis</h5>
                                <canvas id="profitMarginChart" class="canvas"></canvas>
                                <p class="mt-2">Gross Profit Margin: {{ $percentage_of_profits == 0  ? 0 : 100 - number_format( $percentage_of_profits ,1) }}%<br>Net Profit Margin: {{ number_format( $percentage_of_profits ,1) }}%</p>
                            </div>

                        </div>
                        <div class=" mb-4 card-dash">
                            <div class="card-body">
                                <h5 class="card-title">Monthly Revenue</h5>
                                <p>Highest Revenue Trend Over Time:{{ $max_revenue }} ({{ $max_revenue_month }})</p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.clientsData = @json($clients_data);

        var profits = {
            {{--  gross: <?php echo $revenues; ?>,  --}}
            net: <?php echo $percentage_of_profits; ?>,
        };
    </script>
@endsection
