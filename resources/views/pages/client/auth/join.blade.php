@extends('master.app')
@section('content')
    <div>
        <div class="row">

            {{--  <div class="col-lg-6 col-md-6 col-sm-12">

                <h2 class="text_7">@lang('pages.welcome_join')</h2>
            </div>  --}}

            <div class="col-lg-12 col-md-12 col-sm-12 client-sign container ">
                <div class="box_1">
                    <form class="form-group-Sign" action="{{ route('store_join_client') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div class="row">
                                <div class="col-md-6 form-group-Sign">
                                    <label for="name">@lang('pages.name')</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                                        class="form-control" />
                                    @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="col-md-6 form-group-Sign">
                                    <label for="email">@lang('pages.email'):</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="form-control" />
                                    @error('email')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="password">@lang('pages.password'):</label>
                                    <input type="password" id="password" name="password" class="form-control" />
                                    <div class="input-group-append">
                                        {{--  <span class="toggle-password" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>  --}}
                                    </div>
                                    @error('password')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                <div class="col-md-6 form-group-Sign">
                                    <label for="password_confirmation">@lang('pages.password_confirmation')</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" />
                                    <div class="input-group-append">
                                        {{--  <span class="toggle-password" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>  --}}
                                    </div>
                                    @error('password_confirmation')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>



                                <div class="col-md-6 form-group-Sign">
                                    <label for="birth"> @lang('pages.birth')</label>
                                    <input type="text" id="birth" name="birth" value="{{ old('birth') }}"
                                        class="form-control" />
                                    @error('birth')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="phone">@lang('pages.phone')</label>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                        class="form-control" />
                                    @error('phone')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="country">@lang('country')</label>
                                    <select id="country" name="country" value="{{ old('country') }}" class="form-control"
                                        onchange="updateCities()">
                                        <option>@lang('pages.select_country')</option>
                                        <option value="1">@lang('EnumFile.Saudi')</option>
                                        <option value="2">@lang('EnumFile.UAE')</option>
                                    </select>
                                    @error('country')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="city">@lang('pages.city')</label>
                                    <select id="city" name="city" value="{{ old('city') }}" class="form-control">
                                        <option>@lang('pages.select_city')</option>
                                        <option value="1" class="saudi-city">@lang('EnumFile.riyadh')</option>
                                        <option value="2" class="saudi-city">@lang('EnumFile.mecca')</option>
                                        <option value="3" class="saudi-city">@lang('EnumFile.medina')</option>
                                        <option value="4" class="saudi-city">@lang('EnumFile.dammam')</option>
                                        <option value="5" class="saudi-city">@lang('EnumFile.jeddah')</option>
                                        <option value="6" class="saudi-city">@lang('EnumFile.khobar')</option>
                                        <option value="7" class="saudi-city">@lang('EnumFile.abha')</option>
                                        <option value="8" class="saudi-city">@lang('EnumFile.tabuk')</option>
                                        <option value="9" class="saudi-city">@lang('EnumFile.hail')</option>
                                        <option value="10" class="saudi-city">@lang('EnumFile.jazan')</option>
                                        <option value="11" class="saudi-city">@lang('EnumFile.najran')</option>
                                        <option value="12" class="saudi-city">@lang('EnumFile.baha')</option>
                                        <option value="13" class="saudi-city">@lang('EnumFile.al_jouf')</option>

                                        <option value="100">@lang('EnumFile.dubai')</option>
                                        <option value="101">@lang('EnumFile.abu_dhabi')</option>
                                        <option value="102">@lang('EnumFile.ajman')</option>
                                        <option value="103">@lang('EnumFile.rak')</option>
                                        <option value="104">@lang('EnumFile.fujairah')</option>
                                        <option value="105">@lang('EnumFile.um_alq')</option>
                                        <option value="106">@lang('EnumFile.sharjah')</option>


                                    </select>
                                    @error('city')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="emirates_id">@lang('pages.emirates_id')</label>
                                    <input type="text" id="emirates_id" name="emirates_id"
                                        value="{{ old('emirates_id') }}" class="form-control" />
                                    @error('emirates_id')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="occupation">@lang('pages.occupation')</label>
                                    <input type="text" id="occupation" name="occupation"
                                        value="{{ old('occupation') }}" class="form-control" />
                                    @error('occupation')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="front_emirates_id">@lang('pages.emirates_front')</label>
                                    <label for="front_emirates_id" class="upload-icon"><i
                                            class="bx bx-upload icon-sign"></i></label>
                                    <input type="file" id="front_emirates_id" value="{{ old('front_emirates_id') }}"
                                        name="front_emirates_id" class="custom-file-input" />
                                    <div id="upload_front_preview" style="margin-top: 10px">
                                        <!-- The image will be displayed here -->
                                    </div>
                                    @error('front_emirates_id')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="back_emirates_id">@lang('pages.emirates_back')</label>
                                    <label for="back_emirates_id" class="upload-icon"><i
                                            class="bx bx-upload icon-sign"></i></label>
                                    <input type="file" id="back_emirates_id" name="back_emirates_id"
                                        value="{{ old('back_emirates_id') }}" class="custom-file-input" />
                                    <div id="upload_back_preview" style="margin-top: 10px">
                                        <!-- The image will be displayed here -->
                                    </div>
                                    @error('back_emirates_id')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="Gender">@lang('pages.gender'):</label>
                                    <div class="d-flex">

                                        <div class="gender-label">
                                            <input type="radio" id="gender_male" name="gender" value="1"
                                                class="gender-checkbox" {{ old('gender') == 1 ? 'checked' : '' }} />
                                            <label for="gender_male">@lang('EnumFile.male')</label>
                                        </div>

                                        <div class="gender-label">
                                            <input type="radio" id="gender_female" name="gender" value="2"
                                                class="gender-checkbox" {{ old('gender') == 2 ? 'checked' : '' }} />
                                            <label for="gender_female">@lang('EnumFile.female')</label>
                                        </div>

                                        @error('gender')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn1 submit-client">@lang('pages.sing_up')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
