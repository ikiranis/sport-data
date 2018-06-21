<div class="matches">

    <h5 class="text-center font-weight-bold">Αγωνιστική {{$matchday->matchday}}</h5>

    <div class="container">
        <table class="table table-responsive table-sm table-hover ml-auto mr-auto">
            <thead>
            <tr>
                <th scope="col" class="text-center">Ημερομηνία</th>
                <th scope="col" class="text-center">Γήπεδο</th>
                <th scope="col" class="text-center">Αγώνας</th>
                <th scope="col" class="text-right">Σκορ</th>
            </tr>
            </thead>
            <tbody>

            @foreach($matchdayMatches as $match)
                <tr>
                    <td>{{ $match->match_date ? $match->match_date->format('d/m/Y') : 'TBA' }}</td>
                    <td class="w-25">{{ $match->stadium ? $match->stadium->name : ''}}</td>
                    <td class="w-50">{{ $match->teams }}</td>
                    <td class="w-25 text-right">
                        <span class="font-weight-bold">{{$match->first_team_score}}-{{$match->second_team_score}}</span>
                        <span>&nbsp;{{ $match->halfScores ?? '' }}</span>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

</div>



