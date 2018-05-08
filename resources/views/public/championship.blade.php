@extends('layouts.app')

@section('content')
    <h1>{{$championship->name}}</h1>

    <div class="container">
        @if(count($seasons)>0)

            <form method="GET" action="{{route('season')}}">

                @csrf

                <div class="container w-75">
                    <div class="input-group no-gutters ml-auto mr-auto row">
                        <label for="season_id" class="sr-only">Season</label>
                        <select class="form-control col-8 px-2" id="season_id" name="season_id">
                            <option value="0"></option>
                            @foreach($seasons as $season)
                                <option value="{{$season->id}}">
                                    {{$season->name}}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-info col-4 mx-2">
                            Επιλογή season
                        </button>
                    </div>
                </div>

            </form>

        @endif
    </div>

@endsection

