@extends('pages.dashboard.sidebar')
@section('dashboard')
    <div class="col-lg-9 col-md-1">
        <div class="content">
            <h2>Template</h2>
            <div class="list-template-dashboard">
                @foreach ($templates as $template)
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3">

                    @if ($template->user_id == Auth()->user()->id)
                        <form method="GET" action="{{ route('delete_template', $template->id) }}">
                            <button type="submit" class="btn-remove-template">
                                <i class="bx bx-x icon-remove-template"></i>
                            </button>
                        </form>
                    @endif

                    @php
                        $media_url = $template->getFirstMediaUrl('template');
                        $extension = pathinfo($media_url, PATHINFO_EXTENSION);
                        $image_extensions = ['jpg', 'webp', 'png'];
                    @endphp

                    @if (in_array($extension, $image_extensions))
                        <img src="{{ $media_url }}" alt="template" class="img-template-dashboard clickable">
                    @else
                        <a href="{{ $media_url }}" target="_blank">
                            <img src="{{ asset('assets/img/template.png') }}" alt="file" class="img-template-dashboard">
                        </a>
                    @endif

                </div>
            @endforeach

            </div>



            <div class="form-group file-upload col-md-12 Template">
                <form action="{{ route('store_template') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="emiratesIdUpload">Upload Template</label>
                    <input type="file" id="emiratesIdUpload" name="template" class="form-control-file" accept=".pdf,.doc,.docx,.png,.jpg,.webp" />

                    <button type="submit" class="btn_download_book"> <i class="fas fa-upload upload-icon"></i></button>

                    @error('template')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror

                </form>
            </div>

        </div>
    </div>
@endsection
