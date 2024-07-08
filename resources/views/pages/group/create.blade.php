@extends('pages.chat.navChat')
@section('content_chat')

    <head>
        <style>
            .add-member {
                font-size: 20px;
            }


            .user-list-create-group,
            .group-list {
                list-style: none;
                padding: 0;
                max-height: 380px;
                overflow-y: auto;
                font-size: 22px;

            }

            .user-list-create-group li,
            .group-list li {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
                cursor: pointer;
            }

            .user-list-create-group li:hover,
            .group-list li:hover {
                background-color: #f0f0f0;
                border-radius: 15px
            }

            .user-list-create-group li i,
            .group-list li i {
                margin-right: 10px;
            }

            .group-header {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .group-name-create {
                border: none;
                border-bottom: 1px solid #000;
                margin-right: 10px;
                background: none;
                font-size: 20px;
                text-align: center;
            }

            .group-name-create::placeholder {
                color: black;
            }

            .create-button {
                text-align: center;
                background-color: #646262;
                border-radius: 15px;
                width: 50%;
                font-weight: bold;
            }
        </style>
    </head>

    <body>

        <div class="row">
            <div class="col-md-6">
                <h3 class="add-member"><i class="fas fa-user-plus"></i> add members</h3>
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
                <form method="POST" action="{{ route('store_group') }}">
                    @csrf

                    <div class="group-header mb-3">
                        <input class="group-name-create" type="text" id="name" name="name"
                            placeholder="Enter Group Name">
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
                            <button type="submit" class="btn">Create</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>


    </body>
@endsection
