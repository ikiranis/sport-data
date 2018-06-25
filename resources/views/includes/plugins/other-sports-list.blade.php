<div class="card mb-2">

    <div class="card-header">
        <h6 class="text-center">Άλλα αθλήματα</h6>
    </div>

    <div class="card-body p-0">

        <ul class="list-group">

            @foreach($otherSports as $sport)

                <li class="list-group-item list-group-item-action p-1 small">
                    <a href="{{route('sport', $sport->slug)}}">
                        {{ $sport->name }}
                    </a>
                </li>

            @endforeach

        </ul>

    </div>
</div>