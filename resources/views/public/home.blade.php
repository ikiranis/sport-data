@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }}
@endsection

@section('shareMetaTags')
    <meta name="description"
          content="Ο ομαδικός ερασιτεχνικός αθλητισμός στην Δυτική Μακεδονία. Ειδήσεις, αποτελέσματα, βαθμολογίες, στατιστικά"/>

    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description"
          content="Ο ομαδικός ερασιτεχνικός αθλητισμός στην Δυτική Μακεδονία. Ειδήσεις, αποτελέσματα, βαθμολογίες, στατιστικά">
    <meta itemprop="image" content="{{ secure_url('/images/site/logo.png') }}">

    <!-- Twitter Card data -->
    {{--<meta name="twitter:card" content="">--}}
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description"
          content="Ο ομαδικός ερασιτεχνικός αθλητισμός στην Δυτική Μακεδονία. Ειδήσεις, αποτελέσματα, βαθμολογίες, στατιστικά">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="{{ secure_url('/images/site/logo.png') }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}"/>
    <meta property="og:type" content="home"/>
    <meta property="og:image" content="{{ secure_url('/images/site/logo.png') }}"/>
    <meta property="og:image:width" content="282">
    <meta property="og:description"
          content="Ο ομαδικός ερασιτεχνικός αθλητισμός στην Δυτική Μακεδονία. Ειδήσεις, αποτελέσματα, βαθμολογίες, στατιστικά"/>
    <meta property="og:site_name" content="West Macedonia Sports"/>
@endsection

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            @include('includes.sport-images')

        </div>

    </div>

    @include('includes.search-text')

    <div class="container">

        <div class="row no-gutters">

            <div class="container col-lg-10 col-12">
                @if(count($posts)>0)

                    @foreach($posts as $post)

                        @include('includes.post-list')

                    @endforeach

                    @include('includes.paging')

                @endif
            </div>

            <div class="container col-lg-2 col-12 my-3">
                @if(count($lastMatches)>0)
                    @include('includes.plugins.last-matches-list')
                @endif

                @if(count($nextMatches)>0)
                    @include('includes.plugins.next-matches-list')
                @endif

                @if(count($seasons)>0)
                    @include('includes.plugins.standings-list')
                @endif
            </div>


        </div>

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