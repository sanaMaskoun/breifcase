@extends('master.app')
@section('content')
    @php
        use App\Enums\UserTypeEnum;
        use App\Enums\UAECityEnum;
        use App\Enums\SaudiCityEnum;
        use App\Enums\CountryEnum;

        if ($company->country == CountryEnum::Saudi) {
            $location = SaudiCityEnum::getKey($company->city);
        } elseif ($company->country == CountryEnum::UAE) {
            $location = UAECityEnum::getKey($company->city);
        }

    @endphp

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card box">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-6 d-flex align-items-center">

                                <div class="profile-image">
                                    <img src="{{ $company->getFirstMediaUrl('profile') }}" alt="Profile Image"
                                        class="img-fluid rounded-circle" />
                                </div>

                                <div class="ml-3">

                                    <h4> {{ $company->name }} <i class="bx bx-check-circle"></i> </h4>
                                    <p>Location: {{ $location }}</p>

                                    <div class="rating">
                                        <span class="badge">
                                            <i class="fa fa-star"></i>{{ $company->geta_average_rate() }}
                                        </span>

                                        <span class="ml-2">Translation Price:
                                            {{ $company->lawyer?->consultation_price }} AED / page
                                        </span>


                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="description">
                            <p> {{ $company->lawyer?->bio }} </p>
                        </div>



                        <div class="row">
                            <div class="certifications col-md-6">
                                <h5>Certifications:</h5>
                                <div class="row">
                                    @foreach ($company->lawyer?->getMedia('certification') as $certification)
                                        <div class="col-4">
                                            <img src="{{ $certification->getUrl() }}" alt="certification"
                                                class="img_certification_license_profile clickable" />
                                        </div>
                                    @endforeach

                                </div>
                            </div>


                            <div class="col-md-6">
                                <h5>Languages:</h5>
                                <ul>
                                    @foreach ($company->languages as $language)
                                        <li>{{ $language->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        <div class="license">
                            <h5>License:</h5>
                            <div class="row">
                                @foreach ($company->lawyer?->getMedia('license') as $license)
                                    <div class="col-4">
                                        <img src="{{ $license->getUrl() }}" alt="license"
                                            class="img-fluid img_certification_license_profile clickable" />
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="text-right">
                            <a href="{{ route('send_request', base64_encode($company->id)) }}"
                                class=" btn1">send request</a>

                            <a href="{{ route('contact_company', base64_encode($company->id)) }}" class="btn">
                                Contact <br/>
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
