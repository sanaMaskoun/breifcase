@extends('master.app')
@section('content')
    <div class="container box-sign-2 mt-5 col-12">
        <form method="POST" action="{{ route('store_join_translation_company') }}" enctype="multipart/form-data">
            @csrf
            <div class="profile-photo-sign">
                <div class="col-6">
                    <div class="profile-container">
                        <input type="file" id="profilePhotoInput" accept="image/*" name="profile"
                            onchange="loadProfilePhoto(event)" />
                        <div class="profile-photo" id="profilePhoto">
                            <label for="profilePhotoInput">@lang('pages.add_photo')</label>
                        </div>
                    </div>
                </div>
                <div class="col-6 d-flex">
                    <h2>@lang('pages.company')</h2>
                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-6 ">
                    <label for="name" class="label-inline">@lang('pages.company_name')</label>
                    <input type="text" class="form-control-sign input-inline" id="name" name="name"
                       />
                    @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group-sign col-md-4" style="margin-top: 10px">
                    <label for="biography">@lang('pages.bio')</label>
                    <textarea class="form-control-sign" id="biography" rows="3" name="bio" ></textarea>
                    @error('bio')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group-sign file-upload col-md-2" style="height: 50px">
                    <label for="licenseUpload" class="label-inline">
                        @lang('pages.upload_license') <i class="fas fa-upload icon-upload-sign"></i>
                    </label>
                    <input type="file" id="licenseUpload" class="form-control-file" name="licenses[]" multiple />


                    <div class="container img-box-2 col-12">
                        <div class="img-box">
                            <div id="licensePreviewContainer" class="image-preview-container"></div>
                        </div>
                        @error('licenses')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="row">
                <div class="form-group-sign col-md-6 email-2">
                    <label for="email" class="label-inline">@lang('pages.email')</label>
                    <input type="email" class="form-control-sign input-inline" id="email" name="email"
                         />
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>
            <div class="row">
                <div class="form-group-sign col-md-6 email-2">
                    <label for="password" class="label-inline">@lang('pages.password')</label>
                    <input type="password" class="form-control-sign input-inline" id="password" name="password"
                         />
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>
            <div class="row">
                <div class="form-group-sign col-md-6 email-2">
                    <label for="confirmPassword" class="label-inline">@lang('pages.password_confirmation')</label>
                    <input type="password" class="form-control-sign input-inline" id="confirmPassword"
                        name="password_confirmation"  />
                    @error('password_confirmation')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-6 mobile-2">
                    <label for="mobile" class="label-inline">@lang('pages.phone')</label>
                    <input type="text" class="form-control-sign input-inline" id="mobile" name="phone"
                         />
                    @error('phone')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group-sign form-group col-md-6 land-2">
                    <label for="landline" class="label-inline">@lang('pages.land_line')</label>
                    <input type="text" class="form-control-sign input-inline" id="landline" name="land_line"
                         />
                    @error('land_line')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group form-group-sign col-md-6 country-2">
                    <label for="country" class="label-inline">Country</label>
                    <select class="form-control-sign" name="country" id="country" onchange="updateCities()">
                        <option>Select country</option>
                        <option value="1">Saudi Arabia</option>
                        <option value="2">United Arab Emirates</option>
                    </select>
                    @error('country')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="form-group form-group-sign col-md-6 city-2">
                    <label for="city" class="label-inline">City</label>
                    <select class="form-control-sign" id="city" name="city">
                        <option>Select city</option>
                        <option value="1" class="saudi-city">Riyadh</option>
                        <option value="2" class="saudi-city">Mecca</option>
                        <option value="3" class="saudi-city">Medina</option>
                        <option value="4" class="saudi-city">Dammam</option>
                        <option value="5" class="saudi-city">Jeddah</option>
                        <option value="6" class="saudi-city">Khobar</option>
                        <option value="7" class="saudi-city">Abha</option>
                        <option value="8" class="saudi-city">Tabuk</option>
                        <option value="9" class="saudi-city">Hail</option>
                        <option value="10" class="saudi-city">Jazan</option>
                        <option value="11" class="saudi-city">Najran</option>
                        <option value="12" class="saudi-city">Baha</option>
                        <option value="13" class="saudi-city">AlJouf</option>

                        <option value="100">Dubai</option>
                        <option value="101">Abu Dhabi</option>
                        <option value="102">Ajman</option>
                        <option value="103">RAK</option>
                        <option value="104">Fujairah</option>
                        <option value="105">UM_ALQ</option>
                        <option value="106">Sharjah</option>
                    </select>

                </div>

                @error('city')
                <small class="form-text text-danger">{{ $message }}</small>
            @enderror
                <div class="city-2 col-md-3">
                    <label class="lang-1">Languages</label>
                    <div class="form-check-1">
                        @error('languages')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                        @foreach ($languages as $language)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="languages" name="languages[]"
                                    value="{{ $language->id }}" />{{ $language->name }}

                            </div>
                        @endforeach

                    </div>

                </div>

                <div class="form-group-sign file-upload file-upload-1 city-2 col-md-3">
                    <label for="certificationsUpload" class="label-inline">
                        Upload Certifications
                        <i class="fas fa-upload icon-upload-sign"></i>
                    </label>
                    <input type="file" id="certificationsUpload" class="form-control-file input-inline"
                        name="certifications[]" multiple />

                    <div class="container img-box-1 col-12">
                        <div class="img-box">
                            <div id="certificationsPreviewContainer" class="image-preview-container"></div>
                        </div>
                        @error('certifications')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-6 location-2">
                    <label for="location" class="label-inline">Location</label>
                    <input type="text" class="form-control-sign input-inline" name="location" id="location"
                        placeholder="Add Link" />
                    @error('location')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>


            <div class="row">
                <div class="form-group-sign id-back-1 col-md-6">
                    <label for="consultationPrice" class="label-inline">Translation Price</label>
                    <input type="text" class="form-control-sign input-inline" id="consultationPrice"
                        name="consultation_price" placeholder="500 aed" />
                    @error('consultation_price')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group-sign file-upload col-md-6 mt-5">
                    <div class="form-check chek">
                        <label class="form-check-label" for="availability">
                            Tick the box if clients will be able to reach you 24/7
                        </label>
                        <br />
                        <input class="form-check-input" type="checkbox" id="availability" name="available" />
                        <label class="form-check-label" for="availability">
                            Available 24/7
                        </label>
                    </div>
                </div>
            </div>

            <div class="submit-btn">
                <button type="submit submit-btn-1">Sign Up</button>
            </div>
        </form>
    </div>
@endsection
