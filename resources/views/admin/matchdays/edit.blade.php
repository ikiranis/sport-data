@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.update matchday')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('matchdays.update', $matchday->id) }}">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="matchday">{{trans_choice('messages.matchdays',1)}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{trans_choice('messages.matchdays',1)}}</span>
                                </div>
                                <input type="number" min="0" max="100" class="form-control col-10 px-2" id="matchday" name="matchday" value="{{$matchday->matchday}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="season_id" class="sr-only">Season</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Season</span>
                                </div>
                                <select class="form-control col-10 px-2" id="season_id" name="season_id">
                                    @foreach($seasons as $season)
                                        <option value="{{$season->id}}" {{$season->id==$matchday->season_id ? 'selected' : ''}}>
                                            {{ $season->name }} : {{ $season->championship->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
                                    {{__('messages.update')}}
                                </button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
