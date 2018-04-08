@extends('layouts.app')

@section('content')

    <div class="container">

        @include('includes.post-single')

    </div>

@endsection

@section('scripts')


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


@endsection