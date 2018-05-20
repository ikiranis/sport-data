@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : {{ $championship->name }} {{ $season->name }}
@endsection

@section('shareMetaTags')
    <meta name="description" content="Βαθμολογία και αποτελέσματα: {{ $championship->name }} : {{ $season->name }}"/>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $championship->name }} : {{ $season->name }}">
    <meta itemprop="description" content="Βαθμολογία και αποτελέσματα: {{ $championship->name }} : {{ $season->name }}">
    <meta itemprop="image" content="{{ secure_url('/images/site/logo.png') }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="">
    <meta name="twitter:title" content="{{ $championship->name }} : {{ $season->name }}">
    <meta name="twitter:description" content="Βαθμολογία και αποτελέσματα: {{ $championship->name }} : {{ $season->name }}">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="{{ secure_url('/images/site/logo.png') }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $championship->name }} : {{ $season->name }}"/>
    <meta property="og:type" content="data"/>
    <meta property="og:image" content="{{ secure_url('/images/site/logo.png') }}"/>
    <meta property="og:image:width" content="282">
    <meta property="og:description" content="Βαθμολογία και αποτελέσματα: {{ $championship->name }} : {{ $season->name }}"/>
    <meta property="og:site_name" content="West Macedonia Sports"/>
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

