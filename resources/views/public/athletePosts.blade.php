@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : {{$athlete->fullname}}
@endsection

@section('shareMetaTags')
    <meta name="description" content="Σελίδα του αθλητή: {{$athlete->fullname}}"/>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{$athlete->fullname}}">
    <meta itemprop="description" content="Σελίδα του αθλητή: {{$athlete->fullname}}">
    <meta itemprop="image" content="{{ secure_url('/images/site/logo.png') }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="">
    <meta name="twitter:title" content="{{$athlete->fullname}}">
    <meta name="twitter:description" content="Σελίδα του αθλητή: {{$athlete->fullname}}">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="{{ secure_url('/images/site/logo.png') }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{$athlete->fullname}}"/>
    <meta property="og:type" content="category"/>
    <meta property="og:image" content="{{ secure_url('/images/site/logo.png') }}"/>
    <meta property="og:image:width" content="282">
    <meta property="og:description" content="Σελίδα του αθλητή: {{$athlete->fullname}}"/>
    <meta property="og:site_name" content="West Macedonia Sports"/>
@endsection

@section('content')

    <div class="container">

        <h1>{{$athlete->fullname}}</h1>

        @if(count($posts)>0)

            @foreach($posts as $post)

                @include('includes.post-list')

            @endforeach

            @include('includes.paging')

            @include('includes.ads.homepage-google-ad')

        @endif
    </div>

@endsection

@section('scripts')

    @if(count($posts)>0)
        @foreach($posts as $post)
            @if(count($post->teams()->get())>0)
                @include('includes.teams.teams-container-javascript')
            @endif
        @endforeach
    @endif

@endsection