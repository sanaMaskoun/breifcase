@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-container-template">
                            <div class="form-title-template">@lang('pages.add_news')</div>
                            <form action="{{ route('store_news') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">@lang('pages.title')</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="@lang('pages.enter_news_title')">
                                    @error('title')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short description</label>
                                    <textarea type="text" class="form-control" id="short_description" name="short_description"
                                        placeholder="@lang('pages.enter_short_description')"></textarea>
                                    @error('short_description')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">@lang('pages.description')</label>
                                    <textarea type="text" class="form-control" id="description" name="description"
                                        placeholder="@lang('pages.enter_description')"></textarea>
                                    @error('description')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="news">@lang('pages.phone')</label>
                                    <input type="file" class="form-control" id="news" name="news">
                                    @error('news')
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
