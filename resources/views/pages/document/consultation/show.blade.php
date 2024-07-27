@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content">
            @if ($message = Session::get('success'))
                <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="header-documents-dashboard">
                <h2>consultation Details </h2>
                <div class="status-consultation {{ strtolower($status_texts[$consultation->status]) }}">
                    {{ $status_texts[$consultation->status] }}
                </div>

            </div>

            <div class="list-document-dashboard">
                <div class="col-md-6 mt-5 ">
                    <p class="title-consultation-details"> {{ $consultation->title }}</p>
                    <p class="description-consultation-details"> {{ $consultation->description }} </p>
                    <span class="d-flex justify-content-end">{{ $consultation->sender->name }}</span>
                    <span class="d-flex justify-content-end">{{ $consultation->created_at->format('Y/m/d') }}</span>

                </div>
                <div class="col-md-6 mt-5 body-suggestion">
                    <p class="description-consultation-details"> {{ $consultation->answer }}</p>
                    @if (Auth()->user()->id == $consultation->receiver_id && $consultation->answer == null)
                        <form method="POST" action="{{ route('answer_consultation', base64_encode($consultation->id)) }}">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <textarea type="text" name="answer" class="form-control"></textarea>
                                @error('answer')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-center mt-2">
                                <button class="answer-consultation">answer</button>

                            </div>
                        </form>
                    @endif
                    <span class="d-flex justify-content-end"> {{ $consultation->receiver->name }} </span>

                </div>

            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('bill_show', base64_encode($consultation->invoice->id)) }}" class="btn-bill">
                    Bill and Receipt
                </a>
                @role('lawyer')
                    @if ($status_texts[$consultation->status] === 'Ongoing')
                        <form id="close-consultation-form-{{ $consultation->id }}" method="POST"
                            action="{{ route('closed_consultation', base64_encode($consultation->id)) }}"
                            style="display: none;">
                            @csrf
                        </form>

                        <a href="#" class="btn-close-consultation"
                            onclick="event.preventDefault(); document.getElementById('close-consultation-form-{{ $consultation->id }}').submit();">
                            Close the consultation
                        </a>
                    @endif
                @endrole
                @role('admin')
                    @if ($status_texts[$consultation->status] === 'Closed' && $status_invoice != 'accepte')
                        <form id="close-case-form-{{ $consultation->id }}" method="POST"
                            action="{{ route('payment_approval', base64_encode($consultation->id)) }}" style="display: none;">
                            @csrf
                        </form>

                        <a href="#" class="btn-close-document"
                            onclick="event.preventDefault(); document.getElementById('close-case-form-{{ $consultation->id }}').submit();">
                            Payment approval
                        </a>
                    @endif
                @endrole
            </div>

        </div>
    {{--  </div>  --}}
@endsection
