@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : Tag {{$tag->name}}
@endsection

@section('shareMetaTags')
    <meta name="description" content="Tag: {{$tag->name}}"/>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Tag: {{$tag->name}}">
    <meta itemprop="description" content="Tag: {{$tag->name}}">
    <meta itemprop="image" content="{{ secure_url('/images/site/logo.png') }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="">
    <meta name="twitter:title" content="Tag: {{$tag->name}}">
    <meta name="twitter:description" content="Tag: {{$tag->name}}">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="{{ secure_url('/images/site/logo.png') }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="Tag: {{$tag->name}}"/>
    <meta property="og:type" content="category"/>
    <meta property="og:image" content="{{ secure_url('/images/site/logo.png') }}"/>
    <meta property="og:image:width" content="282">
    <meta property="og:description" content="Tag: {{$tag->name}}"/>
    <meta property="og:site_name" content="West Macedonia Sports"/>
@endsection

@section('content')

    <div class="container">

        <h1>{{$tag->name}}</h1>

        @if(count($posts)>0)

            @foreach($posts as $post)

                @include('includes.post-list')

            @endforeach

            <div class="row">
                <div class="ml-auto mr-auto">
                    {{ $posts->links() }}
                </div>
            </div>

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