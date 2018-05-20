<div class="card">

    <div class="card-header">
        <h5 class="text-center">Βαθμολογίες</h5>
    </div>

    <div class="card-body p-0">

        <ul class="list-group">

            @foreach($seasons as $season)

                <li class="list-group-item list-group-item-action p-1">
                    <a href="{{ route('standings', [$season->championship->id, $season->id]) }}">
                        {{ $season->championship->sport->name }} / {{ $season->championship->name }}
                        / {{ $season->name }}
                    </a>
                </li>

            @endforeach

        </ul>

    </div>
</div>