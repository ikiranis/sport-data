@extends('layouts.app')

@section('content')

    <h1>{{__('messages.standings')}}</h1>

    @if($teamsStandings)

        <div id="teams">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Ομάδα</th>
                    <th scope="col">Βαθμολογία</th>
                </tr>
                </thead>
                <tbody>


                @foreach($teamsStandings as $key=>$team)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$team->points}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    @else
        <h1>{{__('messages.teams not exist')}}</h1>
    @endif

@endsection

