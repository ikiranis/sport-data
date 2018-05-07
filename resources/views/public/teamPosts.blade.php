@extends('layouts.app')

@section('content')

    <h1>{{$team->name}}</h1>

    <div class="container">
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
                <script>

                    new Vue({
                        el: '#teamsContainer' + '{!! $post->id !!}',
                        delimiters: ['{%', '%}'],
                        data: {
                            teamsSelected: {!! json_encode($post->teams()->get()) !!}
                        }
                    });

                </script>
            @endif
        @endforeach
    @endif

@endsection