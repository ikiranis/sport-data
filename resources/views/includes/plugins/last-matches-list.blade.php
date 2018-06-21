<div class="card mb-2">

    <div class="card-header">
        <h6 class="text-center">Τελευταίοι αγώνες</h6>
    </div>

    <div class="card-body p-0">

        <ul class="list-group">

            @foreach($lastMatches as $match)

                <li class="list-group-item list-group-item-action p-1 small">
                    <a href="{{ route('standings', [$match->season->championship->id, $match->season->id]) }}"
                       title="{{ $match->season->championship->name }}">
                        {{ $match->first_team->name }} - {{ $match->second_team->name }}
                        <span class="font-weight-bold" title="{{ $match->halfScores ?? '' }}">
                            {{ $match->first_team_score }}-{{ $match->second_team_score }}
                        </span>
                    </a>
                </li>

            @endforeach

        </ul>

    </div>
</div>