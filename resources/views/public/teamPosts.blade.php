@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'laravel') }} : {{$team->name}}
@endsection

@section('content')

    <div class="container">

        <div class="row col-12">
            <div class="col">
                @if(isset($team->logo->fullPathName))
                    <div id="teamLogo">
                        <img src="{{$team->logo->fullPathName}}">
                    </div>
                @endif
            </div>

            <div class="col">
                <h1 class="text-right">{{$team->name}}</h1>
            </div>
        </div>

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

        @if(isset($teamsStandingsArray))

            @foreach($teamsStandingsArray as $key=>$teamsStandings)

                <h3>{{$seasons[$key]->name}}</h3>

                @include('includes.teams-standings')

            @endforeach

        @else

            <h1>Δεν υπάρχει βαθμολογία</h1>

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