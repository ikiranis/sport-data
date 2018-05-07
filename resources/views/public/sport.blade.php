@extends('layouts.app')

@section('content')
    <h1>{{$sport->name}}</h1>

    <div class="container">
        @if(count($posts)>0)

            @if(count($championships)>0)
                @foreach($championships as $championship)
                    <li>
                        <a href="{{route('championship', $championship->id)}}">
                            {{$championship->name}}
                        </a>
                    </li>

                @endforeach
            @endif

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