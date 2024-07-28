@extends('pages.chat.navChat')
@section('content_chat')



    <body>

        <div class="row">
            <div class="col-md-6">
                <h3 class="add-member"><i class="fas fa-user-plus"></i> @lang('pages.add_members')</h3>
                <ul class="user-list-create-group">
                    @foreach ($users as $user)
                        <li data-id="{{ $user->id }}" data-name="{{ $user->name }}"><i
                                class="fas fa-user"></i>{{ $user->name }}
                            <i class="fas fa-comment-dots ml-auto"></i>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-6">
                <form method="POST" action="{{ route('store_general_chat') }}">
                    @csrf

                    <div class="group-header mb-3">
                        <input class="group-name-create" type="text" id="name" name="name"
                            placeholder="@lang('pages.name_forum')">
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <ul class="group-list" id="groupList"> </ul>
                    <input type="hidden" name="members" id="memberIds">
                    @error('members')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror

                    <div class="d-flex justify-content-center">
                        <div class="create-button">
                            <button type="submit" class="btn">@lang('pages.create')</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>


    </body>
@endsection
