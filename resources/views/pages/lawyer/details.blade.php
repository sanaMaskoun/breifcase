@extends('master.app')
@section('content')
    @php
        use App\Enums\UserTypeEnum;
        use App\Enums\UAECityEnum;
        use App\Enums\SaudiCityEnum;
        use App\Enums\CountryEnum;
        $role = UserTypeEnum::getKey($lawyer->type);

        if ($lawyer->country == CountryEnum::Saudi) {
            $location = SaudiCityEnum::getKey($lawyer->city);
        } elseif ($lawyer->country == CountryEnum::UAE) {
            $location = UAECityEnum::getKey($lawyer->city);
        }

    @endphp
    <div class="container mt-5">
        <div class="card box">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="profile-image">
                            <img src="{{ $lawyer->getFirstMediaUrl('profile') }}" alt="Profile Image"
                                class="img-fluid rounded-circle" />
                        </div>
                        <div class="ml-3">
                            <h4>
                                {{ $lawyer->name }}
                                <i class="bx bx-check-circle"></i>
                            </h4>

                            <p> {{ $role }} &nbsp; &nbsp; &nbsp; &nbsp; Firm: ABCD</p>

                            <p>Location: {{ $location }}</p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="rating d-flex align-items-center">
                            <span class="badge">
                                <i class="fa fa-star"></i> {{ $rate }}
                            </span>
                            <span class="ml-2">Consultation price: {{ $lawyer->lawyer?->consultation_price }}</span>
                        </div>
                        <div class="description mt-3">
                            <p>
                                {{$lawyer->lawyer?->bio  }}
                            </p>
                        </div>
                        <div class="certifications mt-3">
                            <h5>Certifications:</h5>
                            <div class="d-flex justify-content-start">
                                <div class="d-flex justify-content-start">
                                    @foreach ($lawyer->lawyer?->getMedia('certification') as $certification)
                                        <img src="{{ $certification->getUrl() }}" alt="Certification" class="img-fluid mx-2" />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="license mt-3">
                            <h5>License:</h5>
                            <div class="d-flex justify-content-start">
                                @foreach ( $lawyer->lawyer?->getMedia('license') as  $license)
                                <img src="{{ $license->getUrl() }}" alt="license" class="img-fluid mx-2" />

                                @endforeach

                            </div>
                        </div>
                        <div class="top-expertise mt-3">
                            <h5>Top Expertise:</h5>
                            <ul>
                                @foreach ($lawyer->practices as  $practice)
                                <li>{{ $practice->name }}</li>

                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-3">
                    <button class="btn btn1">Consultation</button>
                    <button class="btn">
                        Contact<br />
                        <i class="bx bx-chat bx-chat-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
