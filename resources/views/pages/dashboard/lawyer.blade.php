@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-12 col-sm-12 ">
        <div class="sidebar-dashboard">
        <h2>Revenue: **,*** AED</h2>
        <h3>Profit: **,*** AED</h3>


        <div class="container myChart">
            <canvas id="myChart"></canvas>
        </div>

        <div class="row reviews ">
            <div class="col-8">
                <h5>Reviwes : </h5>
                <div class="stars">★★★★☆</div>
                <span>4.5</span>
            </div>

            <div class="col-4">
                <button class="btn-share-suggestions">Share Suggestions</button>
            </div>
        </div>
    </div>
    </div>
@endsection
