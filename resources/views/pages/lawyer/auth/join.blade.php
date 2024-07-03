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
                            <label for="profilePhotoInput">Add photo</label>
                        </div>
                    </div>
                </div>

                <div class="col-6 d-flex">
                    <h2>Lawyer</h2>
                </div>

            </div>

            <div class="row">
                <div class="form-group-sign col-md-5">
                    <label for="name" class="label-inline"> Name</label>
                    <input type="text" class="form-control-sign input-inline" id="name" name="name"
                        placeholder="your Name" />
                    @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group-sign col-md-5">
                    <label for="password" class="label-inline">Password</label>
                    <input type="password" class="form-control-sign input-inline" id="password" name="password"
                        placeholder="1234qwer" />
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-5">
                    <label for="years_of_practice" class="label-inline">years of practice</label>
                    <input type="text" class="form-control-sign input-inline" id="years_of_practice"
                        name="years_of_practice" placeholder="5" />
                    @error('years_of_practice')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group-sign col-md-5">
                    <label for="confirmPassword" class="label-inline">Re-type Password</label>
                    <input type="password" class="form-control-sign input-inline"id="password_confirmation"
                        name="password_confirmation" placeholder="1234qwer" />
                    @error('password_confirmation')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>



            <div class="row">
                <div class="form-group-sign col-md-5">
                    <label class="label-inline">Gender</label>
                    <div class="form-check" style="margin-left: 3.5rem">
                        <input class="form-check-input input-inline" type="radio" name="gender" id="male" value=1 />
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input input-inline" type="radio" name="gender" id="female" value=2 />
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>
                @error('gender')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror

                <div class="form-group-sign col-md-5">
                    <label for="consultationPrice" class="label-inline">Consultation Price</label>
                    <input type="text" class="form-control-sign input-inline" id="consultationPrice"
                        name="consultation_price" placeholder="500 aed" />
                    @error('consultation_price')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group-sign col-md-5">
                    <label for="birth" class="label-inline">Birth</label>
                    <input type="text" class="form-control form-control-sign input-inline" id="email" name="birth"
                        placeholder="00-00-0000" />
                    @error('birth')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group-sign file-upload col-md-3" style="height: 50px">
                    <label for="licenseUpload" class="label-inline">
                        Upload License <i class="fas fa-upload icon-upload-sign"></i>
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
                        Upload Certifications
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
                    <label for="email" class="label-inline">Email</label>
                    <input type="email" class="form-control-sign input-inline" id="email" name="email"
                        placeholder="xx@xxx.com" />
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-5 mobile-1">
                    <label for="mobile" class="label-inline">Mobile Number</label>
                    <input type="text" class="form-control-sign input-inline" id="mobile" name="phone"
                        placeholder="05xxxxxxx" />
                    @error('phone')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-5 land-1">
                    <label for="landline" class="label-inline">Land Line</label>
                    <input type="text" class="form-control-sign input-inline" id="land_line" name="land_line"
                        placeholder="0002" />
                    @error('land_line')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="Expertise col-md-3">
                    <label>Top Expertise/Practices</label>
                    <div class="form-check-1">
                        @foreach ($practices as $practice)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="expertise1" name="practices[]"
                                    value="{{ $practice->id }}" />{{ $practice->name }}
                                @error('practices')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                {{--  <label class="form-check-label" for="expertise1">Expertise 1</label>  --}}
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="Expertise col-md-3">
                    <label>Languages</label>
                    <div class="form-check-1">
                        @foreach ($languages as $language)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="languages" name="languages[]"
                                    value="{{ $language->id }}" />{{ $language->name }}
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
                <div class="form-group form-group-sign col-md-5 city-1">
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
                    @error('city')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group-sign col-md-6 bio" style="margin-top: 10px">
                    <label for="biography">Biography</label>
                    <textarea class="form-control-sign" id="biography" rows="3" name="bio" placeholder="Biography"></textarea>
                    @error('bio')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group-sign col-md-5 location-1">
                    <label for="location" class="label-inline">Location</label>
                    <input type="text" class="form-control-sign input-inline" id="location" name="location"
                        placeholder="Add Link" />
                    @error('location')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="form-group-sign col-md-5 id-1">
                    <label for="emiratesId" class="label-inline">Emirates ID</label>
                    <input type="text" class="form-control-sign input-inline" id="emiratesId" name="emirates_id"
                        placeholder="784xxxxxxx" />
                    @error('emirates_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>




            <div class="row">
                <div class="form-group-sign file-upload col-md-5 id-front">
                    <label for="front" class="label-inline">
                        Upload Emirates ID front
                        <i class="fas fa-upload icon-upload-sign"></i>
                    </label>
                    <input type="file" id="front" name="front_emirates_id" class="form-control-file input-inline"
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
                        Upload Emirates ID back
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
                            Tick the box if clients will be able to reach you 24/7
                        </label>
                        <br />
                        <input class="form-check-input i" type="checkbox" id="availability" name="available" />
                        <label class="form-check-label" for="availability">
                            Available 24/7
                        </label>
                    </div>
                </div>
            </div>

            <div class="submit-btn">
                <button type="submit">Sign Up</button>
            </div>
        </form>

    </div>
@endsection
