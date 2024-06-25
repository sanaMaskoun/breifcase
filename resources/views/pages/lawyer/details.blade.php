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
        $receiver_encoded_id = base64_encode($lawyer->id);

    @endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card box">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 d-flex align-items-center">
                                <div class="profile-image">
                                    <img src="{{ $lawyer->getFirstMediaUrl('profile') }}" alt="Profile Image"
                                        class="img-fluid rounded-circle" />
                                </div>

                                <div class="ml-3">
                                    <h4> {{ $lawyer->name }} <i class="bx bx-check-circle"></i> </h4>
                                    <p> {{ $role }} &nbsp; &nbsp; &nbsp; &nbsp; Firm: ABCD</p>
                                    <p>Location: {{ $location }}</p>
                                    <div class="rating">
                                        <span class="badge">
                                            <i class="fa fa-star"></i>{{ $lawyer->geta_average_rate() }}
                                        </span>
                                        <span class="ml-2">Consultation price:
                                            {{ $lawyer->lawyer?->consultation_price }} AED</span>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="description">
                            <p> {{ $lawyer->lawyer?->bio }} </p>
                        </div>



                        <div class="row">
                            <div class="certifications col-md-6">
                                <h5>Certifications:</h5>
                                <div class="row">
                                    @foreach ($lawyer->lawyer?->getMedia('certification') as $certification)
                                        <div class="col-4">
                                            <img src="{{ $certification->getUrl() }}" alt="license"
                                                class="img_certification_license_profile clickable" />
                                        </div>
                                    @endforeach

                                </div>
                            </div>


                            <div class="col-md-6">
                                <h5>Top Expertise:</h5>
                                <ul>
                                    @foreach ($lawyer->practices as $practice)
                                        <li>{{ $practice->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        <div class="license">
                            <h5>License:</h5>
                            <div class="row">
                                @foreach ($lawyer->lawyer?->getMedia('license') as $license)
                                    <div class="col-4">
                                        <img src="{{ $license->getUrl() }}" alt="license"
                                            class="img-fluid img_certification_license_profile clickable" />
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="text-right">
                            <a href="{{ route('create_document', $receiver_encoded_id) }}"
                                class=" btn1">Consultation</a>
                            <a href="{{ route('comtact', $receiver_encoded_id) }}" class="btn">
                                Contact <br />
                                <i class="bx bx-chat bx-chat-1"></i>
                            </a>
                        </div>


                    </div>

                </div>
            </div>






            @yield('form_document')


        </div>
    </div>
@endsection
