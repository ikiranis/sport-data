@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.users')}}</h1>

    @if($users)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col">E-mail</th>
                <th scope="col">{{__('messages.role')}}</th>
                <th scope="col">{{__('messages.active')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active==1 ? __('messages.active') : __('messages.inactive')}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $users->links() }}
            </div>
        </div>

    @else
        <h1>{{__('messages.users not exist')}}</h1>
    @endif
@endsection
