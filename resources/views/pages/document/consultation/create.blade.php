
@extends('pages.lawyer.show')
@section('form_document')
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card box  card-1 card_send_consultation">
            <p> @lang('pages.title_page_consultation')</p>

            <form method="POST" action="{{ route('store_consultation', $lawyer->id) }}">
                @csrf
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
                    <input type="text" name="title" class="title-consultation" placeholder="@lang('pages.title')">
                    @error('title')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center text-Questions">
                    <textarea name="description" placeholder=" @lang('pages.description')"></textarea>
                    @error('description')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>


                <p> @lang('pages.rejected_document') </p>

                <div class="col-md-12 d-flex justify-content-center btn">
                    <button type="submit" class="btn1">@lang('pages.pay_send')</button>
                </div>

            </form>
        </div>
    </div>
@endsection
