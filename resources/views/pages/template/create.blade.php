@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-container-template">
                            <div class="form-title-template">@lang('pages.upload_template')</div>
                            <form action="{{ route('store_template') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">@lang('pages.template_title')</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="@lang('pages.enter_template_title')">
                                    @error('title')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="btn-upload-template">@lang('pages.upload_file')</label>
                                    <input type="file" name="template" class="form-control-file"
                                        accept=".pdf,.doc,.docx,.png,.jpg,.webp" />
                                    @error('template')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn-store-template  btn-block">@lang('pages.upload')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    {{--  </div>  --}}
@endsection
