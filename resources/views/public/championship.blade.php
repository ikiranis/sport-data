@extends('layouts.app')

@section('content')
    <h1>{{$championship->name}}</h1>

    <div class="container">
        @if(count($seasons)>0)

            @foreach($seasons as $season)
                <li>
                    <a href="{{route('season', $season->id)}}">
                        {{$season->name}}
                    </a>
                </li>

            @endforeach

        @endif
    </div>

@endsection

