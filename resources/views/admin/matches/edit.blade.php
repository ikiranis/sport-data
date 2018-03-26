@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.update match')}}</div>

                    <div id="searchContainer" class="card-body">
                        <form method="POST" action="{{ route('matches.update', $match->id) }}">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label for="sport_id" class="sr-only">{{__('messages.sport')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.sport')}}</span>
                                </div>
                                <select v-on:change="getChampionships()" v-model="sportSelected"
                                        class="form-control col-10 px-2" id="sport_id" name="sport_id">
                                    @foreach($sports as $sport)
                                        <option value="{{$sport->id}}" {{$sport->id==$match->sport_id ? 'selected' : ''}}>
                                            {{$sport->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="championship_id" class="sr-only">{{__('messages.championship')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.championship')}}</span>
                                </div>
                                <select v-on:change="getSeasons()" v-model="championshipSelected"
                                        class="form-control col-10 px-2" id="championship_id" name="championship_id">
                                    <option value="0" disabled>Επιλογή</option>
                                    <option v-for="championship in championships"
                                            :value="championship.id">{% championship.name %}
                                    </option>
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="season_id" class="sr-only">Season</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Season</span>
                                </div>
                                <select v-on:change="getMatchdays()" v-model="seasonSelected"
                                        class="form-control col-10 px-2" id="season_id" name="season_id">
                                    <option value="0" disabled>Επιλογή</option>
                                    <option v-for="season in seasons" :value="season.id">{% season.name %}</option>
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="matchday_id" class="sr-only">{{trans_choice('messages.matchdays',1)}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{trans_choice('messages.matchdays',1)}}</span>
                                </div>
                                <select v-model="matchdaySelected" class="form-control col-10 px-2"
                                        id="matchday_id" name="matchday_id">
                                    <option value="0" disabled>Επιλογή</option>
                                    <option v-for="matchday in matchdays" :value="matchday.id">{% matchday.matchday %}</option>
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="stadium_id" class="sr-only">{{__('messages.stadium')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.stadium')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="stadium_id" name="stadium_id">
                                    @foreach($stadia as $stadium)
                                        <option value="{{$stadium->id}}" {{$stadium->id==$match->stadium_id ? 'selected' : ''}}>
                                            {{$stadium->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="first_team_id" class="sr-only">{{__('messages.team')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.teams')}}</span>
                                </div>

                                <select class="form-control col-5 px-2" id="first_team_id" name="first_team_id">
                                    @foreach($teams as $team)
                                        <option value="{{$team->id}}" {{$team->id==$match->first_team_id ? 'selected' : ''}}>
                                            {{$team->name}}
                                        </option>
                                    @endforeach
                                </select>

                                <label for="second_team_id" class="sr-only">{{__('messages.team')}}</label>
                                <select class="form-control col-5 px-2" id="second_team_id" name="second_team_id">
                                    @foreach($teams as $team)
                                        <option value="{{$team->id}}" {{$team->id==$match->second_team_id ? 'selected' : ''}}>
                                            {{$team->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="first_team_score" class="sr-only">{{__('messages.team')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.score')}}</span>
                                </div>

                                <input type="number" min="0" max="200"  class="form-control col-5 px-2" id="first_team_score" name="first_team_score"
                                    value="{{$match->first_team_score}}">

                                <label for="second_team_score" class="sr-only">{{__('messages.team')}}</label>
                                <input type="number" min="0" max="200" class="form-control col-5 px-2" id="second_team_score" name="second_team_score"
                                       value="{{$match->second_team_score}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="match_date">{{__('messages.date')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.date')}}</span>
                                </div>
                                <input type="date" class="form-control col-10 px-2" id="match_date" name="match_date"
                                       value="{{$match->match_date ? $match->match_date->format('Y-m-d') : ''}}">
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

@section('scripts')

    <script>

        let searchContainer = new Vue({
            delimiters: ['{%', '%}'],
            el: "#searchContainer",
            data: {
                sportSelected: '{!! $match->sport_id !!}',
                championshipSelected: '{!! $match->championship_id !!}',
                seasonSelected: '{!! $match->season_id !!}',
                matchdaySelected: '{!! $match->matchday_id !!}',
                championships: '',
                seasons: '',
                matchdays: ''
            },
            mounted: function() {
               this.getChampionships();
               this.getSeasons();
               this.getMatchdays();
            },
            methods: {
                getChampionships() {
                    axios.get('/api/championships/' + this.sportSelected)
                        .then(response => {
                            this.championships = response.data;
                        })
                        .catch(e => console.log(e));
                },
                getSeasons() {
                    axios.get('/api/seasons/' + this.championshipSelected)
                        .then(response => {
                            this.seasons = response.data;
                        })
                        .catch(e => console.log(e));
                },
                getMatchdays() {
                    axios.get('/api/matchdays/' + this.seasonSelected)
                        .then(response => {
                            this.matchdays = response.data;
                        })
                        .catch(e => console.log(e));
                }
            }
        });

    </script>

@endsection
