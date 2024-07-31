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
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img src="{{ $lawyer->getFirstMediaUrl('profile') }}" alt="Profile"
                            class="img-fluid rounded-circle details-profile-img">
                    </div>

                    <div class="col-md-6">
                        <div class=" row">
                            <label for="name" class="col-sm-5  label-lawyer-details">@lang('pages.name')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="name" name="name"
                                    value="{{ $lawyer->name }}" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <label for="email" class="col-sm-5  label-lawyer-details">@lang('pages.email')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="email" class="form-control-lawyer-details " id="email" name="email"
                                    value="{{ $lawyer->email }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="birth" class="col-sm-5  label-lawyer-details">@lang('pages.birth')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="birth" name="birth"
                                    value="{{ $lawyer->birth }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="phone" class="col-sm-5  label-lawyer-details">@lang('pages.phone')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="phone" name="phone"
                                    value="{{ $lawyer->phone }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="land_line" class="col-sm-5  label-lawyer-details">@lang('pages.land_line')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="land_line" name="land_line"
                                    value="{{ $lawyer->lawyer->land_line }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="country" class="col-sm-5  label-lawyer-details">@lang('pages.country')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="country" name="country"
                                    value="{{ __('EnumFile.' . $country) }}" readonly />
                            </div>
                        </div>
                        <div class=" row">
                            <label for="city" class="col-sm-5  label-lawyer-details">@lang('pages.city')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="city" name="city"
                                    value="{{ __('EnumFile.' . $city) }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="location" class="col-sm-5  label-lawyer-details">@lang('pages.location')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="location" name="location"
                                    value="{{ $lawyer->lawyer->location }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="consultation_price" class="col-sm-5  label-lawyer-details">@lang('pages.consultation_price')</label>
                            <div class="col-sm-7 mb-2">
                                <input type="text" class="form-control-lawyer-details" id="consultation_price"
                                    name="consultation_price" value="{{ $lawyer->lawyer->consultation_price }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="years_of_practice" class="col-sm-5  label-lawyer-details">@lang('pages.years_of_practice')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="years_of_practice"
                                    name="years_of_practice" value="{{ $lawyer->lawyer->years_of_practice }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="emirates_id" class="col-sm-5  label-lawyer-details">@lang('pages.emirates_id')</label>
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
                            <p class="font-weight-bold title-details-lawyer"> @lang('pages.licenses')</p>
                            <div class="image-upload container-img-details-lawyer">
                                @foreach ($lawyer->lawyer->getMedia('license') as $license)
                                    <img src="{{ $license->getUrl() }}" alt="License"
                                        class="certification-img-details clickable">
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-2">
                            <p class="font-weight-bold title-details-lawyer"> @lang('pages.certifications')</p>
                            <div class="image-upload container-img-details-lawyer">
                                @foreach ($lawyer->lawyer->getMedia('certification') as $certification)
                                    <img src="{{ $certification->getUrl() }}" alt="certification"
                                        class="certification-img-details clickable">
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-2">
                            <p class="font-weight-bold title-details-lawyer">@lang('pages.top_expertise')</p>
                            <ul class="list-unstyled">
                                <div class="practices-languages-details">
                                    @foreach ($lawyer->practices as $practice)
                                        <li>{{ $practice->name }}</li>
                                    @endforeach
                                </div>
                            </ul>
                        </div>

                        <div class="mb-2">
                            <p class="font-weight-bold title-details-lawyer">@lang('pages.languages')</p>
                            <ul class="list-unstyled">
                                <div class="practices-languages-details">
                                    @foreach ($lawyer->languages as $language)
                                        <li>{{ $language->name }}</li>
                                    @endforeach
                                </div>
                            </ul>
                        </div>

                        <div class="mb-2">
                            <label for="bio" class="col-sm-4 col-form-label">@lang('pages.bio')</label>
                            <textarea readonly class="form-control bio-details-lawyer" id="bio" name="bio">{{ $lawyer->lawyer->bio }}</textarea>
                        </div>
                    </div>


                </div>


            </div>

        </div>
    {{--  </div>  --}}
@endsection
