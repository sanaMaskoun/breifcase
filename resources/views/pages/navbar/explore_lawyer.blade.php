@extends('master.app')
@section('content')
    <div class="box1 container">
        <div class="row">
            <div class="sidebar col-lg-4 col-md-3 col-sm-12 ">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="text_explore_lawyer">Practices</h2>
                    @foreach ($practices as $practice)
                        <a href="#" class="practice-link" data-id="{{ $practice->id }}">{{ $practice->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="content col-lg-8 col-md-9 col-sm-12">
                <div class="col-12">
                    <h2 class="text_explore_lawyer">Lawyers</h2>
                    <div class="row" id="lawyer-list">
                        @foreach ($lawyers as $lawyer)
                            <div class="profile-card col-lg-3 col-md-6 col-sm-12">
                                @php
                                    $lawyer_encoded_id = base64_encode($lawyer->id);
                                @endphp
                                <a href="{{ route('show_lawyer', $lawyer_encoded_id) }}"> <img
                                        src="{{ $lawyer->getFirstMediaUrl('profile') }}" alt="Profile" /></a>
                                <p>{{ $lawyer->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
