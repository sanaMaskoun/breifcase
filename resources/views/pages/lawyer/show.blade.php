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
                                    <p>@lang('pages.location'): {{ $location }}</p>
                                    <div class="rating">
                                        <span class="badge">
                                            <i class="fa fa-star"></i>{{ $lawyer->geta_average_rate() }}
                                        </span>

                                        <span class="ml-2">@lang('pages.consultation_price'):
                                            {{ $lawyer->lawyer?->consultation_price }} AED
                                        </span>


                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="description">
                            <p> {{ $lawyer->lawyer?->bio }} </p>
                        </div>



                        <div class="row">
                            <div class="certifications col-md-6">
                                <h5>@lang('pages.certifications'):</h5>
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
                                <h5>@lang('pages.top_expertise'):</h5>
                                <ul>
                                    @foreach ($lawyer->practices as $practice)
                                        <li>{{ $practice->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        <div class="license">
                            <h5>@lang('pages.licenses'):</h5>
                            <div class="row">
                                @foreach ($lawyer->lawyer?->getMedia('license') as $license)
                                    <div class="col-4">
                                        <img src="{{ $license->getUrl() }}" alt="license"
                                            class="img-fluid img_certification_license_profile clickable" />
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        {{--  <div class="text-right">
                            <a href="{{ route('create_consultation', $receiver_encoded_id) }}"
                                class=" btn1">@lang('pages.consultation')</a>
                            <a href="{{ route('contact_lawyer', $receiver_encoded_id) }}" class="btn">
                                @lang('pages.contact') <br />
                                <i class="bx bx-chat bx-chat-1"></i>
                            </a>
                        </div>  --}}


                    </div>

                </div>
            </div>






            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card box  card-1 card_send_consultation">
                    <p> @lang('pages.title_page_consultation')</p>

                    <form method="POST" action="{{ route('store_consultation', $lawyer->id) }}">
                        @csrf
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                            <input type="text" name="title" class="title-consultation" placeholder="@lang('pages.title')">
                            @error('title')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-Questions">
                            <textarea name="description" placeholder=" @lang('pages.description')"></textarea>
                            @error('description')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <p> @lang('pages.rejected_document') </p>

                        <div class="col-md-12 d-flex justify-content-center btn">
                            <button type="submit" class="btn1">@lang('pages.pay_send')</button>
                        </div>

                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
