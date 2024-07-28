@extends('pages.dashboard.sidebar')
@section('dashboard')
    @php
        use App\Enums\CountryEnum;
        use App\Enums\UAECityEnum;
        use App\Enums\SaudiCityEnum;

        $country = CountryEnum::getKey($company->country);
        if ($country == 'Saudi') {
            $city = SaudiCityEnum::getKey($company->city);
        }
        if ($country == 'UAE') {
            $city = UAECityEnum::getKey($company->city);
        }
    @endphp
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img src="{{ $company->getFirstMediaUrl('profile') }}" alt="Profile"
                            class="img-fluid rounded-circle details-profile-img">
                    </div>

                    <div class="col-md-7">
                        <div class=" row">
                            <div class="col-lg-5">
                                <label for="name" class="label-lawyer-details">@lang('pages.company_name')</label>
                            </div>
                            <div class="col-lg-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="name" name="name"
                                    value="{{ $company->name }}" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5">
                                <label for="email" class="label-lawyer-details">@lang('pages.email')</label>
                            </div>
                            <div class="col-lg-7  mb-2">
                                <input type="email" class="form-control-lawyer-details " id="email" name="email"
                                    value="{{ $company->email }}" readonly />
                            </div>
                        </div>


                        <div class=" row">
                            <div class="col-lg-5">
                                <label for="phone" class=" label-lawyer-details">@lang('pages.phone')</label>
                            </div>
                            <div class="col-lg-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="phone" name="phone"
                                    value="{{ $company->phone }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <div class="col-lg-5">
                                <label for="land_line" class=" label-lawyer-details">@lang('pages.land_line')</label>
                            </div>
                            <div class="col-lg-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="land_line" name="land_line"
                                    value="{{ $company->lawyer->land_line }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <div class="col-lg-5">
                                <label for="country" class=" label-lawyer-details">@lang('pages.country')</label>
                            </div>
                            <div class="col-lg-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="country" name="country"
                                    value="{{ __('EnumFile' . $country) }}" readonly />
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-lg-5">
                                <label for="city" class=" label-lawyer-details">@lang('pages.city')</label>
                            </div>
                            <div class="col-lg-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="city" name="city"
                                    value="{{ __('EnumFile' . $city) }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <div class="col-lg-5">
                                <label for="location" class=" label-lawyer-details">@lang('pages.location')</label>
                            </div>
                            <div class="col-lg-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="location" name="location"
                                    value="{{ $company->lawyer->location }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <div class="col-lg-5">
                                <label for="consultation_price" class=" label-lawyer-details">
                                    @lang('pages.translation_price')
                                </label>
                            </div>
                            <div class="col-lg-7 mb-2">
                                <input type="text" class="form-control-lawyer-details" id="consultation_price"
                                    name="consultation_price" value="{{ $company->lawyer->consultation_price }}" readonly />
                            </div>
                        </div>

                        <div class="mb-2">
                            <p class="font-weight-bold title-details-lawyer"> @lang('pages.licenses')</p>
                            <div class="image-upload container-img-details-lawyer">
                                @foreach ($company->lawyer->getMedia('license') as $license)
                                    <img src="{{ $license->getUrl() }}" alt="License"
                                        class="certification-img-details clickable">
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-2">
                            <p class="font-weight-bold title-details-lawyer">  @lang('pages.certifications')</p>
                            <div class="image-upload container-img-details-lawyer">
                                @foreach ($company->lawyer->getMedia('certification') as $certification)
                                    <img src="{{ $certification->getUrl() }}" alt="certification"
                                        class="certification-img-details clickable">
                                @endforeach
                            </div>
                        </div>


                    </div>

                    <div class="col-md-3">


                        <div class="mb-2">
                            <p class="font-weight-bold title-details-lawyer"> @lang('pages.languages')</p>
                            <ul class="list-unstyled">
                                <div class="practices-languages-details">
                                    @foreach ($company->languages as $language)
                                        <li>{{ $language->name }}</li>
                                    @endforeach
                                </div>
                            </ul>
                        </div>

                        <div class="mb-2">
                            <label for="bio" class="col-sm-4 col-form-label"> @lang('pages.bio')</label>
                            <textarea readonly class="form-control bio-details-lawyer" id="bio" name="bio">{{ $company->lawyer->bio }}</textarea>
                        </div>
                    </div>


                </div>


            </div>

        </div>
    {{--  </div>  --}}
@endsection
