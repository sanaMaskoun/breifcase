@extends('pages.dashboard.sidebar')
@section('dashboard')


    <div class="col-lg-9 col-md-12 col-sm-12 ">
        <div class="row mb-3 ">


            <button class="btn-admin btn">
              Clients {{ $num_clients }}</button>
            <button class="btn-admin btn">
              Lawyers {{ $num_lawyers }}</button>
            <button class="btn-admin btn">
              Translation Companies {{ $num_companies }}</button>
          </div>
        <div class="sidebar-dashboard">

            <div class="container">

                <div class="row ">

                    <div class="col-12">
                        <p class="p-dash">Profit:
                            {{ $profits }}
                             AED
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{--  <div>  --}}
                            <div>
                                <canvas id="myChartAdmin"></canvas>
                            </div>
                        {{--  </div>  --}}
                        <div class="row d-flex justify-content-between">
                            <div class="col-md-6">
                                <div class="legend mt-3">
                                    <span class="span-1">&#9679;</span> clients
                                    {{ $num_clients }}
                                     <br>
                                    <span class="span-2">&#9679; </span>Lawyers
                                     {{ $num_lawyers }}
                                     <br>
                                    <span class="span-3">&#9679; </span>translation companies
                                    {{ $num_companies }}
                                     <br>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('list_suggestions') }}"> <i class="fas fa-vote-yea"></i>

                                    suggestions
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    window.numClients = @json($clients_data);
    window.numLawyers = @json($lawyers_data);
    window.numCompanies = @json($companies_data);

</script>
@endsection
