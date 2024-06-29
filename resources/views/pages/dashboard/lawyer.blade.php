@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content ">
            <h2>Revenue: **,*** AED</h2>
            <h3>Profit: **,*** AED</h3>
            <canvas id="myChart" class="chart-dashboard"></canvas>
            <div class="reviews">
                <h5>Reviwes : </h5>



                <div class="stars">★★★★☆</div>
                <span>4.5</span>
            </div>
            <button class="btn btn-warning">Share Suggestions</button>
        </div>
    </div>
@endsection
