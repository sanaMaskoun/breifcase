@extends('pages.company.details')
@section('form_document')
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card box  card-1 card_send_consultation">
            <p> Leave your requirements for the company</p>

            <form method="POST" action="{{ route('store_request', base64_encode($company->id)) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                    <input type="text" name="title" class="title-consultation" placeholder="Title">
                    @error('title')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-Questions">
                    <textarea name="description" placeholder=" write requirements for the company"></textarea>
                    @error('description')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <div class="col-md-12 form-group upload-documents">
                    <label for="upload_document">Upload Documents:</label>
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


                <p> in case of not recieving a reply in 72 hours your money will be refunded to your account. </p>

                <div class="col-md-12 d-flex justify-content-center btn">
                    <button type="submit" class="btn1">Pay & Send</button>
                </div>

            </form>
        </div>
    </div>
@endsection
