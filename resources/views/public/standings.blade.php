@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : {{ $championship->name }} {{ $season->name }}
@endsection

@section('content')

    <div class="container">
        <h1 class="text-center">{{ $championship->name }}</h1>
        <h3 class="text-center">{{ $season->name }}</h3>

        @if($teamsStandings)

            @include('includes.teams-standings')

        @else

            <h1>Δεν υπάρχει βαθμολογία</h1>

        @endif

        @if($matches)

            <h3 class="text-center">Αποτελέσματα</h3>

            @foreach($matchdays as $matchday)

                @php
                    $matchdayMatches = $matches->where('matchday_id', $matchday->id)
                @endphp

                @if(count($matchdayMatches)>0)

                    @include('includes.teams-results')

                @endif

            @endforeach

        @else

            <h1>Δεν υπάρχουν αποτελέσματα</h1>

        @endif

    </div>

@endsection

