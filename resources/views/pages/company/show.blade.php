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
                                    <p>@lang('pages.location') {{ $location }}</p>

                                    <div class="rating">
                                        <span class="badge">
                                            <i class="fa fa-star"></i>{{ $company->geta_average_rate() }}
                                        </span>

                                        <span class="ml-2">@lang('pages.translation_price')
                                            {{ $company->lawyer?->consultation_price }} @lang('pages.page_price')
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
                                <h5>@lang('pages.certifications')</h5>
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
                                <h5>@lang('pages.languages'):</h5>
                                <ul>
                                    @foreach ($company->languages as $language)
                                        <li>{{ $language->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>


                        <div class="license">
                            <h5>@lang('pages.licenses'):</h5>
                            <div class="row">
                                @foreach ($company->lawyer?->getMedia('license') as $license)
                                    <div class="col-4">
                                        <img src="{{ $license->getUrl() }}" alt="license"
                                            class="img-fluid img_certification_license_profile clickable" />
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        {{--  <div class="text-right">
                            <a href="{{ route('send_request', base64_encode($company->id)) }}"
                                class=" btn1">@lang('pages.send_request')</a>

                            <a href="{{ route('contact_company', base64_encode($company->id)) }}" class="btn">
                                @lang('pages.contact') <br/>
                                <i class="bx bx-chat bx-chat-1"></i>
                            </a>
                        </div>  --}}


                    </div>

                </div>
            </div>






            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card box  card-1 card_send_consultation">
                    <p> @lang('pages.title_page_send_request')</p>

                    <form method="POST" action="{{ route('store_request', base64_encode($company->id)) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                            <input type="text" name="title" class="title-consultation" placeholder="@lang('pages.title')">
                            @error('title')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-Questions">
                            <textarea name="description" placeholder=" @lang('pages.description_page_send_request')"></textarea>
                            @error('description')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="col-md-12 form-group upload-documents">
                            <label for="upload_document">@lang('pages.upload_document')</label>
                            <label for="upload_document" class="upload-icon">
                                <i class="bx bx-upload icon-sign"></i>
                            </label>
                            <input type="file" id="upload_document" name="upload_document" class="custom-file-input" required
                                onchange="handleFileUpload()" />

                            <div id="upload_document_preview" style="margin-top: 10px; display: none;">

                                    <img id="image_preview" style="max-width: 100%; max-height: 50px;display: none;">

                                    <iframe id="file_preview" style="width: 0; height: 0; display:none!important;">
                                    </iframe>

                                    <div id="file_info" style="display: flex; align-items: center;">
                                        <button id="remove_file" onclick="removeFile()" style="display: none; margin-top: 10px;">
                                            <i class="bx bx-x icon-remove"></i>
                                        </button>
                                    <i class="bx bx-file icon-file"></i>
                                    <p id="file_name" style="margin: 0; font-size: 12px;"></p>
                                </div>



                            </div>
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
