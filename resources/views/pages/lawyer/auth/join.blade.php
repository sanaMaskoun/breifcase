@extends('master.app')
@section('content')
    <div class="container box-sign mt-5">
        <form method="POST" action="{{ route('store_join_lawyer') }}" enctype="multipart/form-data">

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
                    <h2>@lang('pages.lawyer')</h2>
                </div>

            </div>

            <div class="row">
                <div class="form-group-sign col-md-5">
                    <label for="name" class="label-inline"> @lang('pages.name')</label>
                    <input type="text" class="form-control-sign input-inline" id="name" value="{{ old('name')}}" name="name" />
                    @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group-sign col-md-5">
                    <label for="password" class="label-inline">@lang('pages.password')</label>
                    <input type="password" class="form-control-sign input-inline" id="password" name="password" />
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-5">
                    <label for="years_of_practice" class="label-inline">@lang('pages.years_of_practice')</label>
                    <input type="text" class="form-control-sign input-inline" id="years_of_practice"
                        name="years_of_practice"  value="{{ old('years_of_practice')}}"/>
                    @error('years_of_practice')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group-sign col-md-5">
                    <label for="confirmPassword" class="label-inline">@lang('pages.password_confirmation')</label>
                    <input type="password" class="form-control-sign input-inline"id="password_confirmation"
                        name="password_confirmation" />
                    @error('password_confirmation')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>



            <div class="row">
                <div class="form-group-sign col-md-5">
                    <label class="label-inline">@lang('pages.gender')</label>
                    <div class="form-check" style="margin-left: 3.5rem">
                        <input class="form-check-input input-inline" type="radio" name="gender" id="male" value=1 {{ old('gender') == 1 ? 'checked' : '' }}  />
                        <label class="form-check-label" for="male">@lang('EnumFile.male')</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input input-inline" type="radio" name="gender" id="female" value=2 {{ old('gender') == 2 ? 'checked' : '' }}  />
                        <label class="form-check-label" for="female">@lang('EnumFile.female')</label>
                    </div>
                </div>
                @error('gender')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group-sign col-md-5">
                    <label for="consultationPrice" class="label-inline">@lang('pages.consultation_price')</label>
                    <input type="text" class="form-control-sign input-inline" id="consultationPrice"
                        name="consultation_price" value="{{ old('consultation_price')}}" />
                    @error('consultation_price')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group-sign col-md-5">
                    <label for="birth" class="label-inline">@lang('pages.birth')</label>
                    <input type="text" class="form-control form-control-sign input-inline" id="birth" value="{{ old('birth')}}"
                        name="birth" />
                    @error('birth')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group-sign file-upload col-md-3" style="height: 50px">
                    <label for="licenseUpload" class="label-inline">
                        @lang('pages.upload_license') <i class="fas fa-upload icon-upload-sign"></i>
                    </label>
                    <input type="file" id="licenseUpload" class="form-control-file" name="licenses[]" multiple />
                    @error('licenses')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror

                    <div class="container img-box-2 col-12">
                        <div class="img-box">
                            <div id="licensePreviewContainer" class="image-preview-container"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group-sign file-upload col-md-3">
                    <label for="certificationsUpload" class="label-inline">
                        @lang('pages.upload_certificate')
                        <i class="fas fa-upload icon-upload-sign"></i>
                    </label>
                    <input type="file" id="certificationsUpload" name="certifications[]"
                        class="form-control-file input-inline" multiple />
                    @error('certifications')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <div class="container img-box-1 col-12">
                        <div class="img-box">
                            <div id="certificationsPreviewContainer" class="image-preview-container"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="form-group-sign col-md-5 email-1">
                    <label for="email" class="label-inline">@lang('pages.email')</label>
                    <input type="email" class="form-control-sign input-inline" id="email" name="email" value="{{ old('email')}}"
                        />
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-5 mobile-1">
                    <label for="mobile" class="label-inline">@lang('pages.phone')</label>
                    <input type="text" class="form-control-sign input-inline" id="mobile" name="phone" value="{{ old('phone')}}"
                         />
                    @error('phone')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-5 land-1">
                    <label for="landline" class="label-inline">@lang('pages.land_line')</label>
                    <input type="text" class="form-control-sign input-inline" id="land_line" name="land_line" value="{{ old('land_line')}}"
                         />
                    @error('land_line')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="Expertise col-md-3">
                    <label>@lang('pages.top_expertise')</label>
                    <div class="form-check-1">
                        @foreach ($practices as $practice)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="expertise1" name="practices[]"
                                    value="{{ $practice->id }}"
                                    @if(is_array(old('practices')) && in_array($practice->id, old('practices'))) checked @endif />

                                    {{ $practice->name }}
                                @error('practices')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                {{--  <label class="form-check-label" for="expertise1">Expertise 1</label>  --}}
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="Expertise col-md-3">
                    <label>@lang('pages.languages')</label>
                    <div class="form-check-1">
                        @foreach ($languages as $language)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="languages" name="languages[]"
                                    value="{{ $language->id }}"
                                    @if(is_array(old('languages')) && in_array($language->id, old('languages'))) checked @endif />

                                   {{ $language->name }}
                                @error('languages')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                {{--  <label class="form-check-label" for="expertise1">Expertise 1</label>  --}}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="form-group form-group-sign col-md-5 country-1">
                    <label for="country" class="label-inline">@lang('pages.country')</label>
                    <select class="form-control-sign" name="country" id="country" onchange="updateCities()">
                        <option value="">@lang('pages.select_country')</option>
                        <option value="1" {{ old('country') == 1 ? 'selected' : '' }}>@lang('EnumFile.Saudi')</option>
                        <option value="2" {{ old('country') == 2 ? 'selected' : '' }}>@lang('EnumFile.UAE')</option>
                     </select>
                    @error('country')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group form-group-sign col-md-5 city-1">
                    <label for="city" class="label-inline">@lang('pages.city')</label>
                    <select class="form-control-sign" id="city" name="city">
                        <option value="">@lang('pages.select_city')</option>
                        <option value="1" class="saudi-city" {{ old('city') == 1 ? 'selected' : '' }}>@lang('EnumFile.riyadh')</option>
                        <option value="2" class="saudi-city" {{ old('city') == 2 ? 'selected' : '' }}>@lang('EnumFile.mecca')</option>
                        <option value="3" class="saudi-city" {{ old('city') == 3 ? 'selected' : '' }}>@lang('EnumFile.medina')</option>
                        <option value="4" class="saudi-city" {{ old('city') == 4 ? 'selected' : '' }}>@lang('EnumFile.dammam')</option>
                        <option value="5" class="saudi-city" {{ old('city') == 5 ? 'selected' : '' }}>@lang('EnumFile.jeddah')</option>
                        <option value="6" class="saudi-city" {{ old('city') == 6 ? 'selected' : '' }}>@lang('EnumFile.khobar')</option>
                        <option value="7" class="saudi-city" {{ old('city') == 7 ? 'selected' : '' }}>@lang('EnumFile.abha')</option>
                        <option value="8" class="saudi-city" {{ old('city') == 8 ? 'selected' : '' }}>@lang('EnumFile.tabuk')</option>
                        <option value="9" class="saudi-city" {{ old('city') == 9 ? 'selected' : '' }}>@lang('EnumFile.hail')</option>
                        <option value="10" class="saudi-city" {{ old('city') == 10 ? 'selected' : '' }}>@lang('EnumFile.jazan')</option>
                        <option value="11" class="saudi-city" {{ old('city') == 11 ? 'selected' : '' }}>@lang('EnumFile.najran')</option>
                        <option value="12" class="saudi-city" {{ old('city') == 12 ? 'selected' : '' }}>@lang('EnumFile.baha')</option>
                        <option value="13" class="saudi-city" {{ old('city') == 13 ? 'selected' : '' }}>@lang('EnumFile.al_jouf')</option>

                        <option value="100" class="uae-city" {{ old('city') == 100 ? 'selected' : '' }}>@lang('EnumFile.dubai')</option>
                        <option value="101" class="uae-city" {{ old('city') == 101 ? 'selected' : '' }}>@lang('EnumFile.abu_dhabi')</option>
                        <option value="102" class="uae-city" {{ old('city') == 102 ? 'selected' : '' }}>@lang('EnumFile.ajman')</option>
                        <option value="103" class="uae-city" {{ old('city') == 103 ? 'selected' : '' }}>@lang('EnumFile.rak')</option>
                        <option value="104" class="uae-city" {{ old('city') == 104 ? 'selected' : '' }}>@lang('EnumFile.fujairah')</option>
                        <option value="105" class="uae-city" {{ old('city') == 105 ? 'selected' : '' }}>@lang('EnumFile.um_alq')</option>
                        <option value="106" class="uae-city" {{ old('city') == 106 ? 'selected' : '' }}>@lang('EnumFile.sharjah')</option>


                    </select>
                    @error('city')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group-sign col-md-6 bio" style="margin-top: 10px">
                    <label for="biography">@lang('pages.bio')</label>
                    <textarea class="form-control-sign" id="biography" rows="3" name="bio" value="{{ old('bio')}}" ></textarea>
                    @error('bio')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group-sign col-md-5 location-1">
                    <label for="location" class="label-inline">@lang('pages.location')</label>
                    <input type="text" class="form-control-sign input-inline" id="location" name="location" value="{{ old('location')}}"
                         />
                    @error('location')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-5 id-1">
                    <label for="emiratesId" class="label-inline">@lang('pages.emirates_id')</label>
                    <input type="text" class="form-control-sign input-inline" id="emiratesId" name="emirates_id" value="{{ old('emirates_id')}}"
                         />
                    @error('emirates_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>




            <div class="row">
                <div class="form-group-sign file-upload col-md-5 id-front">
                    <label for="front" class="label-inline">
                        @lang('pages.emirates_front')
                        <i class="fas fa-upload icon-upload-sign"></i>
                    </label>
                    <input type="file" id="front" name="front_emirates_id"  class="form-control-file input-inline"
                        accept="image/*" />
                    @error('front_emirates_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <div id="front-1" class="image-preview-container-1"></div>
                </div>
            </div>

            <div class="row id-back">
                <div class="form-group-sign file-upload col-md-5" style="height: 50px">
                    <label for="back" class="label-inline">
                        @lang('pages.emirates_back')
                        <i class="fas fa-upload icon-upload-sign"></i>
                    </label>
                    <input type="file" id="back" class="form-control-file input-inline" accept="image/*"
                        name="back_emirates_id" accept="image/*" />
                    @error('back_emirates_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <div id="back-1" class="image-preview-container-1"></div>
                </div>

                <div class="form-group-sign file-upload col-md-6">
                    <div class="form-check chek">
                        <label class="form-check-label" for="availability">
                            @lang('pages.available')
                        </label>
                        <br />
                        <input class="form-check-input i" type="checkbox" id="availability" name="available"
                          value="1" {{ old('available') ? 'checked' : '' }} />
                        <label class="form-check-label" for="availability">
                            @lang('pages.available_24')
                        </label>
                    </div>
                </div>
            </div>

            <div class="submit-btn">
                <button type="submit">@lang('pages.sing_up')</button>
            </div>
        </form>

    </div>
@endsection
