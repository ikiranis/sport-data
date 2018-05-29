@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : Αναζήτηση
@endsection

@section('shareMetaTags')
    <meta name="description" content="Αναζήτηση για: {{$search}}"/>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Αναζήτηση">
    <meta itemprop="description" content="Αναζήτηση για: {{$search}}">
    <meta itemprop="image" content="">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="">
    <meta name="twitter:title" content="Αναζήτηση">
    <meta name="twitter:description" content="Αναζήτηση για: {{$search}}">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="">

    <!-- Open Graph data -->
    <meta property="og:title" content="Αναζήτηση"/>
    <meta property="og:type" content="category"/>
    <meta property="og:image" content=""/>
    <meta property="og:image:width" content="282">
    <meta property="og:description" content="Αναζήτηση για: {{$search}}"/>
    <meta property="og:site_name" content="West Macedonia Sports"/>
@endsection

@section('content')
    <h1 class="text-center">Αναζήτηση για: {{$search}}</h1>

    <div class="container">

        @if(count($posts)>0)

            @foreach($posts as $post)

                @include('includes.post-list')

            @endforeach

            @include('includes.paging')

        @else
            <h3 class="text-center my-5">Δεν βρέθηκαν δημοσιεύματα</h3>
        @endif

    </div>

@endsection

@section('scripts')

    @if(count($post->teams()->get())>0)
        @include('includes.teams-container-javascript')
    @endif

@endsection
