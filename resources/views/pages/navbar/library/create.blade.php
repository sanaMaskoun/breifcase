@extends('master.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container-template">
                <div class="form-title-template">Upload Book</div>
                <form action="{{ route('download_book') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Book Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter book title">
                        @error('title')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">description</label>
                        <input type="text" class="form-control" id="description" name="description"
                            placeholder="Enter book description">
                        @error('description')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="btn-upload-template">Upload book</label>
                        <input type="file" name="book" class="form-control-file"
                            accept=".pdf,.doc,.docx" />
                        @error('book')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn-store-template  btn-block">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
