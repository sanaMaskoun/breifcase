@extends('pages.dashboard.sidebar')
@section('dashboard')
    @php
        use App\Enums\CountryEnum;
        use App\Enums\UAECityEnum;
        use App\Enums\SaudiCityEnum;

        $country = CountryEnum::getKey($client->country);
        if ($country == 'Saudi') {
            $city = SaudiCityEnum::getKey($client->city);
        }
        if ($country == 'UAE') {
            $city = UAECityEnum::getKey($client->city);
        }
    @endphp
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-2 text-center">
                        <img src="{{ $client->getFirstMediaUrl('profile') }}" alt="Profile"
                            class="img-fluid rounded-circle details-profile-img">
                    </div>

                    <div class="col-md-10">
                        <div class=" row">
                            <label for="name" class="col-sm-3  label-lawyer-details">@lang('pages.name')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="name" name="name"
                                    value="{{ $client->name }}" readonly />
                            </div>
                        </div>

                        <div class="row">
                            <label for="email" class="col-sm-3  label-lawyer-details">@lang('pages.email')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="email" class="form-control-lawyer-details " id="email" name="email"
                                    value="{{ $client->email }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="birth" class="col-sm-3  label-lawyer-details">@lang('pages.birth')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="birth" name="birth"
                                    value="{{ $client->birth }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="occupation" class="col-sm-3  label-lawyer-details">@lang('pages.occupation')</label>
                            <div class="col-sm-7 mb-2">
                                <input type="text" class="form-control-lawyer-details" id="occupation"
                                    name="occupation" value="{{ $client->client->occupation }}" readonly />
                            </div>
                        </div>



                        <div class="row">
                            <label for="gender" class="col-sm-3 label-lawyer-details">@lang('pages.gender')</label>
                            <div class="col-sm-7 mb-2">
                                <input type="text" class="form-control-lawyer-details" id="gender" name="gender"
                                    value="{{ $client->gender == 1 ? __('EnumFile.male') : __('EnumFile.female') }}" readonly />
                            </div>
                        </div>
                        



                        <div class=" row">
                            <label for="phone" class="col-sm-3  label-lawyer-details">@lang('pages.phone')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="phone" name="phone"
                                    value="{{ $client->phone }}" readonly />
                            </div>
                        </div>



                        <div class=" row">
                            <label for="country" class="col-sm-3  label-lawyer-details">@lang('pages.country')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="country" name="country"
                                value="{{ __('EnumFile.country' . $country) }}" readonly />
                            </div>
                        </div>

                        <div class=" row">
                            <label for="city" class="col-sm-3  label-lawyer-details">@lang('pages.city')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details " id="city" name="city"
                                value="{{ __('EnumFile.city_' . $city) }}" readonly />
                            </div>
                        </div>
                        <div class=" row">
                            <label for="emirates_id" class="col-sm-3  label-lawyer-details">@lang('pages.emirates_id')</label>
                            <div class="col-sm-7  mb-2">
                                <input type="text" class="form-control-lawyer-details" id="emirates_id"
                                    name="emirates_id" value="{{ $client->emirates_id }}" readonly />
                            </div>
                        </div>

                        <div class="d-flex container-img-details-lawyer">
                            <img src="{{ $client->getFirstMediaUrl('front_emirates_id') }}" alt="front emirates id"
                                class="emirates-img-details clickable">
                            <img src="{{ $client->getFirstMediaUrl('back_emirates_id') }}" alt="back emirates id"
                                class="emirates-img-details clickable">
                        </div>

                    </div>





                </div>


            </div>

        </div>
    {{--  </div>  --}}
@endsection
