<div class="matches">

    <h5 class="text-center font-weight-bold">Αγωνιστική {{$matchday->matchday}}</h5>

    <table class="table table-responsive table-sm table-hover">
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
                <td style="width:10%;">{{ $match->match_date ? $match->match_date->format('d/m/Y') : 'TBA' }}</td>
                <td style="width:20%;">{{ $match->stadium ? $match->stadium->name : ''}}</td>
                <td style="width:70%;">{{ $match->teams }}</td>
                <td style="width:10%;" class="text-right">
                    <span class="font-weight-bold">{{$match->first_team_score}}-{{$match->second_team_score}}</span><span>&nbsp;{{ $match->halfScores ?? '' }}</span>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

</div>



