@extends('layouts.app')

@section('content')

    <div class="container">

        @include('includes.post-single')

    </div>

@endsection

@section('scripts')


    @if(count($post->teams()->get())>0)
        @include('includes.teams-container-javascript')
    @endif


@endsection