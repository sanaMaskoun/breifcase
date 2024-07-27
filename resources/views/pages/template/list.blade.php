@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
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
                            $mimeType = $template->getFirstMedia('template')->mime_type;
                        @endphp

                        @if (str_starts_with($mimeType, 'image'))
                            <img src="{{ $media_url }}" alt="template" class="img-template-dashboard clickable">
                            <h5 class="text-center">{{ $template->title }}</h5>
                        @elseif ($mimeType === 'application/pdf')
                            <a href="{{ $media_url }}" target="_blank" class="title-template">
                                <i class="fas fa-file-pdf icon-file-template"></i>
                                <h5 class="text-center">{{ $template->title }}</h5>
                            </a>
                        @elseif (
                            $mimeType === 'application/msword' ||
                                $mimeType === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                            <a href="{{ $media_url }}" target="_blank" class="title-template">
                                <i class="fas fa-file-word icon-file-template"></i>
                                <h5 class="text-center">{{ $template->title }}</h5>
                            </a>
                        @endif
                    </div>
                @endforeach

            </div>



            <div class="form-group file-upload col-md-12 Template">
                <form method="GET" action="{{ route('create_template') }}" enctype="multipart/form-data">
                    @csrf
                    <button type="submit" class="btn_download_book">
                        <i class="fas fa-upload upload-icon-template"></i>
                        Upload Template
                    </button>

                </form>
            </div>

        </div>
    {{--  </div>  --}}
@endsection
