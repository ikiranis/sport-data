@extends('layouts.app')

@include('includes.social-buttons-javascript')

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
