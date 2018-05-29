@extends('layouts.app')

@include('includes.social-buttons-javascript')

@section('siteTitle')
    {{ config('app.name', 'laravel') }} : {{$team->name}}
@endsection

@section('shareMetaTags')
    <meta name="description" content="Σελίδα της ομάδας: {{$team->name}}"/>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{$team->name}}">
    <meta itemprop="description" content="Σελίδα της ομάδας: {{$team->name}}">
    <meta itemprop="image" content="">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="">
    <meta name="twitter:title" content="{{$team->name}}">
    <meta name="twitter:description" content="Σελίδα της ομάδας: {{$team->name}}">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{$team->name}}"/>
    <meta property="og:type" content="category"/>
    <meta property="og:image" content=""/>
    <meta property="og:description" content="Σελίδα της ομάδας: {{$team->name}}"/>
    <meta property="og:site_name" content="West Macedonia Sports"/>
@endsection

@section('content')

    <div class="container">

        <div class="row col-12 no-gutters">
            <div class="col">
                @if(isset($team->logo->fullPathName))
                    <div id="teamLogo">
                        <img src="{{$team->logo->fullPathName}}">
                    </div>
                @endif
            </div>

            <div class="col">
                <h1 class="text-right">{{$team->name}}</h1>
                @if(isset($team->link))
                    <div class="text-right websiteLink">
                        <a href="{{ $team->link }}">{{ parse_url($team->link)['host'] }}</a>
                    </div>
                @endif
            </div>
        </div>

        @if(count($posts)>0)

            @foreach($posts as $post)

                @include('includes.post-list')

            @endforeach

            @include('includes.paging')

        @endif

        @if(isset($teamsStandingsArray))

            @foreach($teamsStandingsArray as $key=>$teamsStandings)

                <h3>{{$seasons[$key]->name}}</h3>

                @include('includes.teams-standings')

            @endforeach

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

@section('scripts')

    @if(count($posts)>0)
        @foreach($posts as $post)
            @if(count($post->teams()->get())>0)
                @include('includes.teams-container-javascript')
            @endif
        @endforeach
    @endif

@endsection