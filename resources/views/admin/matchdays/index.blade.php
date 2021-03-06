@extends('layouts.admin')

@section('content')
    <h1>{{trans_choice('messages.matchdays',2)}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('matchdays.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert matchday')}}</button>
        </a>
    </div>

    @if(count($matchdays)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{trans_choice('messages.matchdays',1)}}</th>
                <th scope="col" class="text-center">Season</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($matchdays as $matchday)
                <tr>
                    <td><a href="{{route('matchdays.edit', $matchday->id)}}">{{$matchday->matchday}}</a></td>
                    <td>{{$matchday->season->name}} : {{ $matchday->season->championship->name }}</td>
                    <td>
                        <form method="POST" action="{{route('matchdays.destroy', $matchday->id)}}">
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
                {{ $matchdays->links() }}
            </div>
        </div>


    @else
        <h1>{{__('messages.matchdays not exist')}}</h1>
    @endif
@endsection
