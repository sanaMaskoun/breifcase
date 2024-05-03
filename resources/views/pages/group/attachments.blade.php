@extends('master.app')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">@lang('pages.file')</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body profile">
                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0  table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>@lang('pages.file')</th>
                                            <th>@lang('pages.sender')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $message)
                                            @if ($message->getFirstMediaUrl('attachments') != null)
                                                <tr>
                                                    <td>
                                                        @if (
                                                            $message->getMedia('attachments')->first()->extension == 'jpg' ||
                                                                $message->getMedia('attachments')->first()->extension == 'png')
                                                            <img class=" img_file"
                                                                src="{{ asset($message->getFirstMediaUrl('attachments')) }}"
                                                                data-toggle="modal" data-target="#imageModal"
                                                                onclick="showModalImage('{{ asset($message->getFirstMediaUrl('attachments')) }}')"><span>{{ $message->message }}</span>
                                                        @else
                                                            <a href="{{ $message->getFirstMediaUrl('attachments') }}"   target="_blank"> <i
                                                                    class="fas fa-file file_attachments"></i><span>{{ $message->message }}</span></a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $message->sender->name }}
                                                    </td>
                                                </tr>
                                            @endif

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination">
                                <span class="page-info">@lang('pagination.pages') {{ $messages->currentPage() }} @lang('pagination.of')
                                    {{ $messages->lastPage() }}</span>
                                @if ($messages->previousPageUrl() || $messages->nextPageUrl())
                                    <a href="{{ $messages->previousPageUrl() }}" class="prev"
                                        @if (!$messages->previousPageUrl()) disabled @endif>@lang('pagination.previous')</a>
                                    <a href="{{ $messages->nextPageUrl() }}" class="next"
                                        @if (!$messages->nextPageUrl()) disabled @endif>@lang('pagination.next')</a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Image </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <img id="modalImage" style="max-width: 100%;" src="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function showModalImage(imageUrl) {
            $('#modalImage').attr('src', imageUrl);
        }
    </script>
@endsection
