@extends('pages.dashboard.sidebar')
@section('dashboard')
    {{--  <div class="col-lg-9 col-md-1">  --}}
        <div class="content ">
            <div class="header-documents-dashboard">
                <h2>Requests</h2>
                <span class="num-document">Total {{ $num_requests }} </span>

            </div>
            <div class="search-status mt-2">
                <input value="{{ request('search') }}" name="search" type="text"
                    class="form-control form-input input-search-status" id="statusSearch" placeholder="Enter status" />
            </div>
            <div class="list-document-dashboard">
                @foreach ($requests as $request)
                    <div class="col-lg-3 col-md-6 col-sm-12  mt-4 document-item">
                      <a href="{{ route('show_requests' , base64_encode($request->id)) }}" > <img src="{{ asset('assets/img/template-dashboard.png') }}" alt="request Image" class="img-doc">
                    </a>
                        <h5 class="title-document-dashboard">{{ $request->title }}</h5>
                        <div class="container-details-document-dashboard">
                            {{--  <p class="details-document-dashboard">{{ $request->sender->name }}</p>  --}}
                            <p class="details-document-dashboard">{{ $request->created_at->format('Y/m/d') }}</p>
                            <div class="status-consultation {{ strtolower($status_texts[$request->status]) }}">
                                {{ $status_texts[$request->status] }}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    {{--  </div>  --}}
@endsection
