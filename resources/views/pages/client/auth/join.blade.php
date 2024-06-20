@extends('master.app')
@section('content')

    <div >
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
                                    <input type="text" id="name" name="name"
                                        class="form-control" required />
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control" required />
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="password">password:</label>
                                    <input type="text" id="password" name="password" class="form-control"
                                        required />
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="Gender">Gender:</label>
                                    <div class="d-flex">

                                        <div class="gender-label">
                                            <input type="checkbox" id="gender" name="gender" value="MALE"
                                                class="gender-checkbox" />
                                            <label for="gender">MALE</label>
                                        </div>

                                        <div class="gender-label">
                                            <input type="checkbox" id="gender" name="gender" value="FEMALE"
                                                class="gender-checkbox" />
                                            <label for="gender">FEMALE</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="birth"> Birth:</label>
                                    <input type="text" id="birth" name="birth" class="form-control"
                                        required />
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="phone">Phone:</label>
                                    <input type="tel" id="phone" name="phone"
                                        class="form-control" required />
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="country">Country:</label>
                                    <select id="country" name="country" class="form-control" required>
                                        <option value="United Arab Emirates">
                                            United Arab Emirates
                                        </option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                    </select>
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="city">City:</label>
                                    <select id="city" name="city" class="form-control" required>
                                        <option value="Abu Dhabi">Abu Dhabi</option>
                                        <option value="Dubai">Dubai</option>
                                        <option value="Sharjah">Sharjah</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="emirates_id">Emirates ID:</label>
                                    <input type="text" id="emirates_id" name="emirates_id"
                                        class="form-control" required />
                                </div>

                                <div class="col-md-6 form-group-Sign">
                                    <label for="Occupation">Occupation:</label>
                                    <input type="text" id="Occupation" name="Occupation"
                                        class="form-control" required />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="upload_front">Upload Emirates ID Front:</label>
                                    <label for="upload_front" class="upload-icon"><i class="bx bx-upload icon-sign"></i>
                                    </label>
                                    <input type="file" id="upload_front" name="upload_front"
                                        class="custom-file-input" required />
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="upload_back">Upload Emirates ID Back:</label>
                                    <label for="upload_back" class="upload-icon"><i class="bx bx-upload icon-sign"></i>
                                    </label>
                                    <input type="file" id="upload_back" name="upload_back" class="custom-file-input"
                                        required />
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
