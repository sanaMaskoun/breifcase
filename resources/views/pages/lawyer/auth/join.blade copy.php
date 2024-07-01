@extends('master.app')
@section('content')
    <div class="container box">
        <form method="POST" action="{{ route('store_join_lawyer') }}" enctype="multipart/form-data">
            @csrf

            <div class="profile-photo">
                <div class="col-6">
                    <img src="" alt="Profile Photo" id="profileImage" />

                    <label class="btn btn-sm btn1"> Add Photo
                        <input type="file" id="profile" name="profile" accept="image/*" style="display: none" />
                    </label>
                </div>
                <div class="col-6 d-flex">
                    <h2>Lawyer</h2>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="name" class="label-inline">First Name</label>
                    <input type="text" class="form-control input-inline" id="name" name="name"
                        placeholder="your Name" />
                    @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-5">
                    <label for="password" class="label-inline">Password</label>
                    <input type="password" class="form-control input-inline" id="password" name="password"
                        placeholder="1234qwer" />
                    @error('password')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-5">
                    <label for="years_of_practice" class="label-inline">years of practice</label>
                    <input type="text" class="form-control input-inline" id="years_of_practice" name="years_of_practice"
                        placeholder="500 aed" />
                    @error('years_of_practice')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-5">
                    <label for="confirmPassword" class="label-inline">Re-type Password</label>
                    <input type="password" class="form-control input-inline" id="password_confirmation"
                        name="password_confirmation" placeholder="1234qwer" />
                    @error('password_confirmation')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-5">
                    <label class="label-inline">Gender</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value=1 />
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value=2 />
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>

                <div class="form-group col-md-5">
                    <label for="consultation_price" class="label-inline">Consultation Price</label>
                    <input type="text" class="form-control input-inline" id="consultation_price"
                        name="consultation_price" placeholder="500" />
                    @error('consultation_price')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="birth" class="label-inline">Birth</label>
                    <input type="text" class="form-control input-inline" id="birth" name="birth"
                        placeholder="00-00-0000" />
                    @error('birth')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group file-upload col-md-3" style="height: 50px">
                    <label for="licenseUpload" class="label-inline">
                        Upload License <i class="fas fa-upload upload-icon"></i>
                    </label>

                    <input type="file" id="licenseUpload" name="licenses[]" class="form-control-file" multiple />
                    @error('licenses')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <div class="container img-box-2 col-12">
                        <div class="img-box">
                            <div id="licensePreviewContainer" class="image-preview-container"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group file-upload col-md-3">
                    <label for="certificationsUpload" class="label-inline">
                        Upload Certifications <i class="fas fa-upload upload-icon"></i>
                    </label>
                    <input type="file" name="certifications[]" id="certificationsUpload"
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

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="email" class="label-inline">Email</label>
                    <input type="email" class="form-control input-inline" id="email" name="email"
                        placeholder="xx@xxx.com" />
                    @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="phone" class="label-inline">Mobile Number</label>
                    <input type="text" class="form-control input-inline" id="phone" name="phone"
                        placeholder="05xxxxxxx" />
                    @error('phone')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="landline" class="label-inline">Land Line</label>
                    <input type="text" class="form-control input-inline" id="land_line" name="land_line"
                        placeholder="02xxxxxxx" />
                    @error('land_line')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="Expertise col-md-3">
                    <label>Top Expertise/Practices</label>

                    <div class="form-check-1">
                        @foreach ($practices as $practice)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="practices" name="practices[]"
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

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="country" class="label-inline">Country</label>
                    <select class="form-control" id="country" name="country" onchange="updateCities()">
                        <option>Select country</option>
                        <option value="1">Saudi Arabia</option>
                        <option value="2">United Arab Emirates</option>
                    </select>
                    @error('country')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="city" class="label-inline">City</label>
                    <select class="form-control" id="city" name="city">
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

                <div class="form-group col-md-6">
                    <label for="bio"> Biography</label>
                    <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="bio"></textarea>
                    @error('bio')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="location" class="label-inline">Location</label>
                    <input type="text" class="form-control input-inline" id="location" name="location"
                        placeholder="Add Link" />
                    @error('location')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="emirates_id" class="label-inline">Emirates ID</label>
                    <input type="text" class="form-control input-inline" id="emirates_id" name="emirates_id"
                        placeholder="784xxxxxxx" />
                    @error('emirates_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-row">

                <div class="form-group file-upload col-md-5" style="height: 50px">
                    <label for="front_emirates_id" class="label-inline">
                        Upload Emirates ID front <i class="fas fa-upload upload-icon"></i>
                    </label>
                    <input type="file" id="front_emirates_id" name="front_emirates_id"
                        class="form-control-file input-inline" />
                    @error('front_emirates_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <div id="licensePreviewContainerFront" class="image-preview-container-1"></div>
                </div>

                <div class="form-group file-upload col-md-5" style="height: 50px">
                    <label for="back_emirates_id" class="label-inline">
                        Upload Emirates ID back <i class="fas fa-upload upload-icon"></i>
                    </label>
                    <input type="file" id="back_emirates_id" name="back_emirates_id"
                        class="form-control-file input-inline" />
                    @error('back_emirates_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <div id="licensePreviewContainerBack" class="image-preview-container-1"></div>
                </div>
            </div>

            <div class="form-row" style="margin-top: 40px">
                <div class="form-group file-upload col-md-8">
                    <div class="form-check chek">
                        <label class="form-check-label" for="available">
                            Tick the box if clients will be able to reach you 24/7
                        </label>
                        <br />
                        <input class="form-check-input" type="checkbox" id="available" name="available" />
                        <label class="form-check-label" for="available">
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
