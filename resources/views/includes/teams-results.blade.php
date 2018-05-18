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
                <td>{{ $match->match_date ? $match->match_date->format('d/m/Y') : 'TBA' }}</td>
                <td class="col-2">{{ $match->stadium ? $match->stadium->name : ''}}</td>
                <td class="col-8">{{ $match->teams }}</td>
                <td class="col-2 text-right font-weight-bold">{{$match->first_team_score}}-{{$match->second_team_score}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>

</div>



