@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-container-template">
                            <div class="form-title-template">Add News</div>
                            <form action="{{ route('store_news') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter news title">
                                    @error('title')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short description</label>
                                    <textarea type="text" class="form-control" id="short_description" name="short_description"
                                        placeholder="Enter news short description"></textarea>
                                    @error('short_description')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" id="description" name="description"
                                        placeholder="Enter news description"></textarea>
                                    @error('description')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="news">photo</label>
                                    <input type="file" class="form-control" id="news" name="news">
                                    @error('news')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn-store-template  btn-block">save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    {{--  </div>  --}}
@endsection
