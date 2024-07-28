@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-container-template">
                            <div class="form-title-template">@lang('pages.add_Practice')</div>
                            <form action="{{ route('store_practiece') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">@lang('pages.name')</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="@lang('pages.enter_practice_name')">
                                    @error('name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">@lang('pages.description')</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="@lang('pages.enter_practice_description')">
                                    @error('description')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn-store-template  btn-block">@lang('pages.save')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    {{--  </div>  --}}
@endsection
