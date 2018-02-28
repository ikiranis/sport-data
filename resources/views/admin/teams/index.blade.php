@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.teams')}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('teams.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert team')}}</button>
        </a>
    </div>

    @if(count($teams)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col">{{__('messages.city')}}</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($teams as $team)
                <tr>
                    <th scope="row">{{$team->id}}</th>
                    <td><a href="{{route('teams.edit', $team->id)}}">{{$team->name}}</a></td>
                    <td>{{$team->city}}</td>
                    <td>
                        <form method="POST" action="{{route('teams.destroy', $team->id)}}">
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
                {{ $teams->links() }}
            </div>
        </div>


    @else
        <h1>{{__('messages.teams not exist')}}</h1>
    @endif
@endsection
