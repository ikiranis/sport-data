@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.teams')}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('teams.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert team')}}</button>
        </a>
    </div>

    @if($teams)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col">{{__('messages.city')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($teams as $team)
                <tr>
                    <th scope="row">{{$team->id}}</th>
                    <td>{{$team->name}}</td>
                    <td>{{$team->city}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $teams->links() }}
            </div>
        </div>


    @else
        <h1>{{__('messages.teams not exist')}}</h1>
    @endif
@endsection
