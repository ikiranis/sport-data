<div class="card mb-2">

    <div class="card-header">
        <h5 class="text-center">Τελευταία ματς</h5>
    </div>

    <div class="card-body p-0">

        <ul class="list-group">

            @foreach($lastMatches as $match)

                <li class="list-group-item list-group-item-action p-1 small">
                    <a href="">
                        {{ $match->first_team->name }} - {{ $match->second_team->name }}
                        <strong>{{ $match->first_team_score }}-{{ $match->second_team_score }}</strong>
                    </a>
                </li>

            @endforeach

        </ul>

    </div>
</div>