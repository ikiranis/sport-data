<h3 class="text-center">Βαθμολογία</h3>

<div class="teams">
    <table class="table table-responsive table-sm table-hover">
        <thead>
        <tr>
            <th scope="row">#</th>
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


        @php ($position = 1)

        @foreach($teamsStandings as $key=>$team)
            <tr>
                <td scope="row">{{$position}}</td>
                <td class="col font-weight-bold"><a href="{{route('team', $team->data->slug)}}">{{$key}}</a></td>
                <td class="col text-center">{{$team->matches}}</td>
                <td class="col text-center">{{$team->wins}}</td>
                <td class="col text-center">{{$team->draws}}</td>
                <td class="col text-center">{{$team->loses}}</td>
                <td class="col text-center">{{$team->scoreFor}}</td>
                <td class="col text-center">{{$team->scoreAgainst}}</td>
                <td class="col text-center">{{$team->scoreFor - $team->scoreAgainst}}</td>
                <td class="col text-center font-weight-bold">{{$team->points}}</td>
            </tr>
            @php ($position++)
        @endforeach

        </tbody>
    </table>

</div>