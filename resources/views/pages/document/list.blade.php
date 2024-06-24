@extends('pages.client.details')

@section('profile_content')
<div class="box-profile-1 ">
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Consultations')">Consultations</button>
        <button class="tablinks" onclick="openCity(event, 'Cases')">Cases</button>
    </div>

    <div id="Consultations" class="tabcontent">

        @foreach ($consultations as $consultation)
            <div class="col-lg-6 col-md-6 col-sm-12 consultation-card">
                <img src="{{ asset('assets/img/consultation.png') }}" alt="Consultation Image" class="img-doc">
                <div>
                    <p>title:<span> {{ $consultation->title }} </span></p>
                    <p>lawyer:<span>{{ $consultation->receiver->name }}</span> </p>
                </div>
            </div>
        @endforeach
    </div>

    <div id="Cases" class="tabcontent">

        @foreach ($cases as $case)
            <div class="col-lg-6 col-md-6 col-sm-12 consultation-card">
                <img src="{{ asset('assets/img/case.png') }}" alt="Cases Image" class="img-doc">
                <p>title: <span>{{ $case->title }}</span> </p>
                <p>lawyer:<span>{{ $case->receiver->name }}</span> </p>

            </div>
        @endforeach
    </div>
</div>
@endsection
