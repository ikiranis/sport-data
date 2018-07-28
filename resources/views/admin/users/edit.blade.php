@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.update user')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="name">{{__('messages.name')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-9 px-2" id="name" name="name"
                                       value="{{$user->name}}" autocomplete="off">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="email">{{__('messages.lname')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">e-mail</span>
                                </div>
                                <input type="email" max="255" class="form-control col-9 px-2" id="email" name="email"
                                       value="{{$user->email}}" autocomplete="off">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="password">{{__('messages.password')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.password')}}</span>
                                </div>
                                <input type="password" max="255" class="form-control col-9 px-2" id="password" name="password"
                                       value="{{$user->password}}" autocomplete="off">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="role_id" class="sr-only">{{__('messages.role')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.role')}}</span>
                                </div>
                                <select class="form-control col-9 px-2" id="role_id" name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{$role->id==$user->role_id ? 'selected' : ''}}>
                                            {{$role->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters my-2">
                                <label for="is_active" class="sr-only">{{__('messages.approve')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100 bg-warning">{{__('messages.approve')}}</span>
                                </div>
                                <select class="form-control col-9 px-2" id="is_active" name="is_active">
                                    <option value="0" {{$user->is_active==0 ? 'selected' : ''}} >{{__('messages.inactive')}}</option>
                                    <option value="1" {{$user->is_active==1 ? 'selected' : ''}}>{{__('messages.active')}}</option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
                                    {{__('messages.update')}}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
