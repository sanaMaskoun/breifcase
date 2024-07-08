@extends('pages.dashboard.sidebar')
@section('dashboard')
    @php
        use App\Enums\CountryEnum;
        use App\Enums\UAECityEnum;
        use App\Enums\SaudiCityEnum;

        $country = CountryEnum::getKey($lawyer->country);
        if ($country == 'Saudi') {
            $city = SaudiCityEnum::getKey($lawyer->city);
        }
        if ($country == 'UAE') {
            $city = UAECityEnum::getKey($lawyer->city);
        }
    @endphp
    <div class="col-lg-9 col-md-1">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img src="{{ $lawyer->getFirstMediaUrl('profile') }}" alt="Profile"
                            class="img-fluid rounded-circle details-profile-img">
                    </div>

                    <div class="col-md-6">
                        <div class=" row">
                            <label for="name" class="col-sm-5  label-lawyer-details">Name</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="name" name="name"
                                    value="{{ $lawyer->name }}" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <label for="email" class="col-sm-5  label-lawyer-details">Email</label>
                            <div class="col-sm-7  mb-2">
                                <input type="email" class="form-control-lawyer-details " id="email" name="email"
                                    value="{{ $lawyer->email }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="birth" class="col-sm-5  label-lawyer-details">Date of Birth</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="birth" name="birth"
                                    value="{{ $lawyer->birth }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="phone" class="col-sm-5  label-lawyer-details">Mobile Number</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="phone" name="phone"
                                    value="{{ $lawyer->phone }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="land_line" class="col-sm-5  label-lawyer-details">Land Line</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="land_line" name="land_line"
                                    value="{{ $lawyer->lawyer->land_line }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="country" class="col-sm-5  label-lawyer-details">Country</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="country" name="country"
                                    value="{{ $country }}" readonly />
                            </div>
                        </div>
                        <div class=" row">
                            <label for="city" class="col-sm-5  label-lawyer-details">City</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="city" name="city"
                                    value="{{ $city }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="location" class="col-sm-5  label-lawyer-details">Location</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="location" name="location"
                                    value="{{ $lawyer->lawyer->location }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="consultation_price" class="col-sm-5  label-lawyer-details">Consultation
                                price</label>
                            <div class="col-sm-7 mb-2">
                                <input type="text" class="form-control-lawyer-details" id="consultation_price"
                                    name="consultation_price" value="{{ $lawyer->lawyer->consultation_price }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="years_of_practice" class="col-sm-5  label-lawyer-details">Years of practice</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="years_of_practice"
                                    name="years_of_practice" value="{{ $lawyer->lawyer->years_of_practice }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="emirates_id" class="col-sm-5  label-lawyer-details">Emirates id</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="emirates_id"
                                    name="emirates_id" value="{{ $lawyer->emirates_id }}" readonly />
                            </div>
                        </div>

                        <div class="d-flex container-img-details-lawyer">
                            <img src="{{ $lawyer->getFirstMediaUrl('front_emirates_id') }}" alt="front emirates id"
                                class="emirates-img-details clickable">
                            <img src="{{ $lawyer->getFirstMediaUrl('back_emirates_id') }}" alt="back emirates id"
                                class="emirates-img-details clickable">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-2">
                            <p class="font-weight-bold title-details-lawyer"> Licenses</p>
                            <div class="image-upload container-img-details-lawyer">
                                @foreach ($lawyer->lawyer->getMedia('license') as $license)
                                    <img src="{{ $license->getUrl() }}" alt="License"
                                        class="certification-img-details clickable">
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-2">
                            <p class="font-weight-bold title-details-lawyer"> certifications</p>
                            <div class="image-upload container-img-details-lawyer">
                                @foreach ($lawyer->lawyer->getMedia('certification') as $certification)
                                    <img src="{{ $certification->getUrl() }}" alt="certification"
                                        class="certification-img-details clickable">
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-2">
                            <p class="font-weight-bold title-details-lawyer">Top Expertise/Practices</p>
                            <ul class="list-unstyled">
                                <div class="practices-languages-details">
                                    @foreach ($lawyer->practices as $practice)
                                        <li>{{ $practice->name }}</li>
                                    @endforeach
                                </div>
                            </ul>
                        </div>

                        <div class="mb-2">
                            <p class="font-weight-bold title-details-lawyer">Languages</p>
                            <ul class="list-unstyled">
                                <div class="practices-languages-details">
                                    @foreach ($lawyer->languages as $language)
                                        <li>{{ $language->name }}</li>
                                    @endforeach
                                </div>
                            </ul>
                        </div>

                        <div class="mb-2">
                            <label for="bio" class="col-sm-4 col-form-label">Biography</label>
                            <textarea readonly class="form-control bio-details-lawyer" id="bio" name="bio">{{ $lawyer->lawyer->bio }}</textarea>
                        </div>
                    </div>


                </div>


            </div>

        </div>
    </div>
    </div>
@endsection
