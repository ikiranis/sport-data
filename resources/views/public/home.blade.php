@extends('layouts.app')

@include('includes.social-buttons-javascript')

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
    <meta itemprop="image" content="">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description"
          content="Ο ομαδικός ερασιτεχνικός αθλητισμός στην Δυτική Μακεδονία. Ειδήσεις, αποτελέσματα, βαθμολογίες, στατιστικά">
    <!-- Twitter summary card with large image must be at least 280x150px -->
    <meta name="twitter:image:src" content="">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}"/>
    <meta property="og:type" content="home"/>
    <meta property="og:image" content=""/>
    <meta property="og:description"
          content="Ο ομαδικός ερασιτεχνικός αθλητισμός στην Δυτική Μακεδονία. Ειδήσεις, αποτελέσματα, βαθμολογίες, στατιστικά"/>
    <meta property="og:site_name" content="West Macedonia Sports"/>
@endsection

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            @foreach($sports as $sport)

                <div class="col-lg col-12 my-1">
                    <a href="{{route('sport', $sport->slug)}}">
                        <div class="card">
                            <div class="card-header">{{$sport->name}}</div>

                            <img src="{{$sport->photo ? $sport->photo->fullPathName : 'http://via.placeholder.com/350x150'}}"
                                 class="card-img-bottom">
                        </div>
                    </a>
                </div>
            @endforeach

        </div>

    </div>





    <div class="container">

        <div class="row no-gutters">

            <div class="container col-lg-10 col-12">
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

            <div class="container col-lg-2 col-12 my-3">
                @if(count($seasons)>0)
                    @include('includes.standings-list')
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