<h3 class="text-center">Βαθμολογία</h3>

<div class="teams">
    <table class="table table-responsive table-sm table-hover">
        <thead>
        <tr>
            <th scope="row" class="align-middle">#</th>
            <th scope="col" class="text-center align-middle">Ομάδα</th>
            <th scope="col" class="text-center align-middle">Αγώνες</th>
            <th scope="col" class="text-center align-middle">Νίκες</th>
            <th scope="col" class="text-center align-middle">Ισοπαλίες</th>
            <th scope="col" class="text-center align-middle">Ήττες</th>
            <th scope="col" class="text-center align-middle">Υπέρ</th>
            <th scope="col" class="text-center align-middle">Κατά</th>
            <th scope="col" class="text-center align-middle">Υπέρ Εντός</th>
            <th scope="col" class="text-center align-middle">Κατά Εντός</th>
            <th scope="col" class="text-center align-middle">Υπέρ Εκτός</th>
            <th scope="col" class="text-center align-middle">Κατά Εκτός</th>
            <th scope="col" class="text-center align-middle">Διαφορά</th>
            <th scope="col" class="text-center align-middle">Βαθμολογία</th>
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
                <td class="col text-center">{{$team->scoreForIn}}</td>
                <td class="col text-center">{{$team->scoreAgainstIn}}</td>
                <td class="col text-center">{{$team->scoreForOut}}</td>
                <td class="col text-center">{{$team->scoreAgainstOut}}</td>
                <td class="col text-center">{{$team->scoreFor - $team->scoreAgainst}}</td>
                <td class="col text-center font-weight-bold">{{$team->points}}</td>
            </tr>
            @php ($position++)
        @endforeach

        </tbody>
    </table>

</div>