@extends('master.app')
@section('content')
    <div>
        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-12">

                <h2 class="text_7">Welcome to our community</h2>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 ">
                <div class="box_1">
                    <form class="form-group-Sign" action="{{ route('store_join_client') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 form-group-Sign">
                                    <label for="name">Name:</label>
                                    <input type="text" id="name" name="name" class="form-control" />
                                    @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="col-md-6 form-group-Sign">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control" />
                                    @error('email')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="password">Password:</label>
                                    <input type="password" id="password" name="password" class="form-control" />
                                    <div class="input-group-append">
                                        <span class="toggle-password" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>
                                <div class="col-md-6 form-group-Sign">
                                    <label for="password_confirmation">Password Confirmation:</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" />
                                    <div class="input-group-append">
                                        <span class="toggle-password" style="cursor: pointer;">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    @error('password_confirmation')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>



                                <div class="col-md-6 form-group-Sign">
                                    <label for="birth"> Birth:</label>
                                    <input type="text" id="birth" name="birth" class="form-control" />
                                    @error('birth')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="phone">Phone:</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" />
                                    @error('phone')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="country">Country:</label>
                                    <select id="country" name="country" class="form-control" onchange="updateCities()">
                                        <option >Select country</option>
                                        <option value="1">Saudi Arabia</option>
                                        <option value="2">United Arab Emirates</option>
                                    </select>
                                    @error('country')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="city">City:</label>
                                    <select id="city" name="city" class="form-control">
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

                                <div class="col-md-6 form-group-Sign">
                                    <label for="emirates_id">Emirates ID:</label>
                                    <input type="text" id="emirates_id" name="emirates_id" class="form-control" />
                                    @error('emirates_id')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="occupation">Occupation:</label>
                                    <input type="text" id="occupation" name="occupation" class="form-control" />
                                    @error('occupation')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="front_emirates_id">Upload Emirates ID Front:</label>
                                    <label for="front_emirates_id" class="upload-icon"><i
                                            class="bx bx-upload icon-sign"></i></label>
                                    <input type="file" id="front_emirates_id" name="front_emirates_id"
                                        class="custom-file-input" />
                                    <div id="upload_front_preview" style="margin-top: 10px">
                                        <!-- The image will be displayed here -->
                                    </div>
                                    @error('front_emirates_id')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="back_emirates_id">Upload Emirates ID Back:</label>
                                    <label for="back_emirates_id" class="upload-icon"><i
                                            class="bx bx-upload icon-sign"></i></label>
                                    <input type="file" id="back_emirates_id" name="back_emirates_id"
                                        class="custom-file-input" />
                                    <div id="upload_back_preview" style="margin-top: 10px">
                                        <!-- The image will be displayed here -->
                                    </div>
                                    @error('back_emirates_id')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="Gender">Gender:</label>
                                    <div class="d-flex">

                                        <div class="gender-label">
                                            <input type="checkbox" id="gender" name="gender" value=1
                                                class="gender-checkbox" />
                                            <label for="gender">MALE</label>
                                        </div>

                                        <div class="gender-label">
                                            <input type="checkbox" id="gender" name="gender" value=2
                                                class="gender-checkbox" />
                                            <label for="gender">FEMALE</label>
                                        </div>
                                        @error('gender')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror

                                    </div>
                                </div>


                                <div class="col-md-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn1">Sign Up</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
