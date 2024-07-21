@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="form-container-template">
                            <div class="form-title-template">Upload Template</div>
                            <form action="{{ route('store_case' ,[base64_encode($template->id) , $receiver_encode_id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Case Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter template title">
                                    @error('title')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="Enter case description">
                                    @error('description')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price">price</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        placeholder="Enter case price">
                                    @error('price')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="template">Template</label>

                                    @php
                                        $media_url = $template->getFirstMediaUrl('template');
                                        $mimeType = $template->getFirstMedia('template')->mime_type;
                                    @endphp

                                    @if (str_starts_with($mimeType, 'image'))
                                        <img src="{{ $media_url }}" alt="template"
                                            class="img-template-dashboard clickable">
                                    @elseif ($mimeType === 'application/pdf')
                                        <a href="{{ $media_url }}" target="_blank" class="title-template">
                                            <i class="fas fa-file-pdf icon-file-template"></i>
                                        </a>
                                    @elseif (
                                        $mimeType === 'application/msword' ||
                                            $mimeType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                                        <a href="{{ $media_url }}" target="_blank" class="title-template">
                                            <i class="fas fa-file-word icon-file-template"></i>
                                        </a>
                                    @endif
                                </div>

                                <button type="submit" class="btn-store-template  btn-block">save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection