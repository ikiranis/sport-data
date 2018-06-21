<div class="card mb-2">

    <div class="card-header">
        <h6 class="text-center">Επόμενοι αγώνες</h6>
    </div>

    <div class="card-body p-0">

        <ul class="list-group">

            @foreach($nextMatches as $match)

                <li class="list-group-item list-group-item-action p-1 small">
                    <a href="{{ route('standings', [$match->season->championship->id, $match->season->id]) }}"
                        title="{{ $match->season->championship->name }}">
                        {{ $match->first_team->name }} - {{ $match->second_team->name }}
                        ({{ $match->match_date->format('d/m') }})
                    </a>
                </li>

            @endforeach

        </ul>

    </div>
</div>