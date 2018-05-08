@extends('layouts.app')

@section('content')

    @if($teamsStandings)

        <h1>Βαθμολογία</h1>

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
        <h1>Δεν υπάρχει βαθμολογία</h1>
    @endif

    @if($matches)

        <h1>Αποτελέσματα</h1>

        {{dd($matchdays)}}

        <div id="matches">

            @foreach($matchdays as $matchday)

                <h4>Αγωνιστική {{$matchday->matchday}}</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Αγώνας</th>
                        <th scope="col">Σκορ</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($matches->where('matchday_id', $matchday->id) as $match)
                        <tr>
                            <td>{{$match->teams}}</td>
                            <td>{{$match->first_team_score}} - {{$match->second_team_score}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            @endforeach

        </div>
    @else
        <h1>Δεν υπάρχουν αποτελέσματα</h1>
    @endif

@endsection

