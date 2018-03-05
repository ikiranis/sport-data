@extends('layouts.admin')

@section('content')
    <h1>{{trans_choice('messages.matches',2)}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('matches.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert match')}}</button>
        </a>
    </div>

    @if(count($matches)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{trans_choice('messages.matches',1)}}</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($matches as $match)
                <tr>
                    <th scope="row">{{$matchday->id}}</th>
                    <td><a href="{{route('matches.edit', $match->id)}}">{{$matchday->matchday}}</a></td>
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
                {{ $matches->links() }}
            </div>
        </div>

    @else
        <h1>{{__('messages.matches not exist')}}</h1>
    @endif

    <div id="myApp">
        <paok></paok>
    </div>

@endsection

