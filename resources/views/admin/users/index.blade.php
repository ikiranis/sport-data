@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.users')}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('users.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert user')}}</button>
        </a>
    </div>

    @if(count($users)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col">E-mail</th>
                <th scope="col">{{__('messages.role')}}</th>
                <th scope="col">{{__('messages.active')}}</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
                <tr>
                    <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active==1 ? __('messages.active') : __('messages.inactive')}}</td>
                    <td>
                        <form method="POST" action="{{route('users.destroy', $user->id)}}">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf

                            <button type="submit" class="btn btn-danger">
                                {{__('messages.delete')}}
                            </button>
                        </form>
                    </td>
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
