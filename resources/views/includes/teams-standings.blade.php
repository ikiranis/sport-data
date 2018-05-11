<h3 class="text-center">Βαθμολογία</h3>

<div id="teams">
    <table class="table table-responsive">
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