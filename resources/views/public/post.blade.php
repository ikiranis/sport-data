@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : {{ $post->title }}
@endsection

@section('shareMetaTags')
    <meta name="description" content="{{ $post->description }}"/>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $post->title }}">
    <meta itemprop="description" content="{{ $post->description }}">
    <meta itemprop="image" content="{{ $post->photo ? url($post->photo->full_path_name) : ''}}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="{{ $post->photo ? url($post->photo->full_path_name) : ''}}">
    {{--<meta name="twitter:site" content="">--}}
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->description }}">
    {{--<meta name="twitter:creator" content="">--}}
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="{{ $post->photo ? url($post->photo->full_path_name) : ''}}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $post->title }}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{ secure_url('/' . $post->slug) }}"/>
    <meta property="og:image" content="{{ $post->photo ? url($post->photo->full_path_name) : ''}}"/>
    <meta property="og:image:width" content="282">
    <meta property="og:description" content="{{ $post->description }}"/>
    <meta property="og:site_name" content="West Macedonia Sports"/>
    <meta property="article:published_time" content="{{ $post->created_at }}"/>
    <meta property="article:modified_time" content="{{ $post->updated_at }}"/>
    {{--<meta property="article:section" content="Article Section"/>--}}
    @php
        $tags = '';
        foreach($post->teams as $team) {
             $tags = $tags . $team->name . ' ';
        }
    @endphp
    <meta property="article:tag" content="{{ $tags }}"/>
    {{--<meta property="fb:admins" content="Facebook numberic ID"/>--}}

@endsection

@section('content')

    <div class="container">

        @include('includes.post-single')

    </div>



@endsection

@section('scripts')

    {{--@include('includes.social-buttons-javascript')--}}

    @if(count($post->teams()->get())>0)
        @include('includes.teams-container-javascript')
    @endif
    @if(count($post->tags()->get())>0)
        @include('includes.tags-container-javascript')
    @endif

@endsection
