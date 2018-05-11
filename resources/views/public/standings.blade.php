@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : Αποτελέσματα/Βαθμολογίες
@endsection

@section('content')

    <div class="container">
        <h1 class="text-center">{{ $championship->name }}</h1>
        <h3 class="text-center">{{ $season->name }}</h3>

        @if($teamsStandings)

            <h3 class="text-center">Βαθμολογία</h3>

            <div id="teams">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">Ομάδα</th>
                        <th scope="col" class="text-center">Αγώνες</th>
                        <th scope="col" class="text-center">Νίκες</th>
                        <th scope="col" class="text-center">Ισοπαλίες</th>
                        <th scope="col" class="text-center">Ήττες</th>
                        <th scope="col" class="text-center">Υπέρ</th>
                        <th scope="col" class="text-center">Κατά</th>
                        <th scope="col" class="text-center">Διαφορά</th>
                        <th scope="col" class="text-center">Βαθμολογία</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($teamsStandings as $key=>$team)
                        <tr>
                            <td class="font-weight-bold"><a href="{{route('team', $team->data->slug)}}">{{$key}}</a></td>
                            <td class="text-center">{{$team->matches}}</td>
                            <td class="text-center">{{$team->wins}}</td>
                            <td class="text-center">{{$team->draws}}</td>
                            <td class="text-center">{{$team->loses}}</td>
                            <td class="text-center">{{$team->scoreFor}}</td>
                            <td class="text-center">{{$team->scoreAgainst}}</td>
                            <td class="text-center">{{$team->scoreFor - $team->scoreAgainst}}</td>
                            <td class="text-center font-weight-bold">{{$team->points}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>

        @else

            <h1>Δεν υπάρχει βαθμολογία</h1>

        @endif

        @if($matches)

            <h3 class="text-center">Αποτελέσματα</h3>

            <div id="matches">

                @foreach($matchdays as $matchday)

                    @php
                        $matchdayMatches = $matches->where('matchday_id', $matchday->id)
                    @endphp

                    @if(count($matchdayMatches)>0)

                        <h5 class="text-center font-weight-bold">Αγωνιστική {{$matchday->matchday}}</h5>

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">Ημερομηνία</th>
                                <th scope="col" class="text-center">Αγώνας</th>
                                <th scope="col" class="text-center">Σκορ</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($matchdayMatches as $match)
                                <tr>
                                    <td class="text-center">{{ $match->match_date ? $match->match_date->format('d / m / Y') : '' }}</td>
                                    <td>{{ $match->teams }}</td>
                                    <td class="text-center">{{$match->first_team_score}} - {{$match->second_team_score}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    @endif

                @endforeach

            </div>

        @else

            <h1>Δεν υπάρχουν αποτελέσματα</h1>

        @endif

    </div>

@endsection
