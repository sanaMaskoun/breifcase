@
@extends('pages.lawyer.details')
@section('form_document')
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card box  card-1 card_send_consultation">
            <p> Write in details what you need consultation for</p>

            <form method="POST" action="{{ route('store_document', $lawyer->id) }}">
                @csrf
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                    <input type="text" name="title" class="title-consultation" placeholder="Title">
                    @error('title')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-Questions">
                    <textarea name="description" placeholder=" write consultation"></textarea>
                    @error('description')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <p> in case of not recieving a reply in 72 hours your money will be refunded to your account. </p>

                <div class="col-md-12 d-flex justify-content-center btn">
                    <button type="submit" class="btn1">Pay & Send</button>
                </div>

            </form>
        </div>
    </div>
@endsection
