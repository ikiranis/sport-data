@extends('layouts.admin')

@section('content')

    @include('includes.apiToken')

    <h1>{{trans_choice('messages.matches',2)}}</h1>

    <div id="searchContainer">
        <form method="GET">
            <div class="row">

                @csrf

                <div class="input-group mb-3 no-gutters col-lg col-12 my-1">
                    <label for="sport_id" class="sr-only">{{__('messages.sport')}}</label>
                    <div class="input-group-prepend col-5">
                        <span class="input-group-text w-100">{{__('messages.sport')}}</span>
                    </div>
                    <select v-on:change="getChampionships()" v-model="sportSelected" class="form-control col-7 px-2"
                            id="sport_id" name="sport_id">
                        <option value="0" disabled>Επιλογή</option>
                        @foreach($sports as $sport)
                            <option value="{{$sport->id}}">
                                {{$sport->name}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3 no-gutters col-lg col-12 my-1">
                    <label for="championship_id" class="sr-only">{{__('messages.championship')}}</label>
                    <div class="input-group-prepend col-5">
                        <span class="input-group-text w-100">{{__('messages.championship')}}</span>
                    </div>
                    <select v-on:change="getSeasons()" v-model="championshipSelected" class="form-control col-7 px-2"
                            id="championship_id" name="championship_id">
                        <option value="0" disabled>Επιλογή</option>
                        <option v-for="championship in championships" :value="championship.id">{% championship.name %}
                        </option>
                    </select>
                </div>

                <div class="input-group mb-3 no-gutters col-lg col-12 my-1">
                    <label for="season_id" class="sr-only">Season</label>
                    <div class="input-group-prepend col-5">
                        <span class="input-group-text w-100">Season</span>
                    </div>
                    <select v-on:change="getMatchdays()" v-model="seasonSelected" class="form-control col-7 px-2"
                            id="season_id" name="season_id">
                        <option value="0" disabled>Επιλογή</option>
                        <option v-for="season in seasons" :value="season.id">{% season.name %}</option>
                    </select>
                </div>

                <div class="input-group mb-3 no-gutters col-lg col-12 my-1">
                    <label for="matchday_id" class="sr-only">{{trans_choice('messages.matchdays',1)}}</label>
                    <div class="input-group-prepend col-5">
                        <span class="input-group-text w-100">{{trans_choice('messages.matchdays',1)}}</span>
                    </div>
                    <select class="form-control col-7 px-2" v-model="matchdaySelected"
                            id="matchday_id" name="matchday_id">
                        <option value="0" disabled>Επιλογή</option>
                        <option v-for="matchday in matchdays" :value="matchday.id">{% matchday.matchday %}</option>
                    </select>
                </div>

                <div class="col-lg-3 col-12 my-1">
                    <button type="submit" class="btn btn-success w-100" formaction="{{route('matches.index')}}">
                        {{__('messages.search')}}
                    </button>
                </div>

                <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
                    <button type="submit" class="btn btn-info w-100" formaction="{{route('matches.create')}}">
                        {{__('messages.insert match')}}
                    </button>
                </div>

                <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
                    <button type="submit" class="btn btn-info w-100" formaction="{{route('matches.create.massive')}}">
                        {{__('messages.insert matches')}}
                    </button>
                </div>

            </div>
        </form>


    </div>


    @if(count($matches)>0)
        <script>
            let matches = @json($matches);
            window.LaravelAuth = @json([
               'apiToken' => $userApiToken ?? null,
            ]);
        </script>

        <div id="matches">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">{{trans_choice('messages.matches',1)}}</th>
                    <th scope="col">{{__('messages.score')}}</th>
                    <th scope="col">{{__('messages.action')}}</th>
                </tr>
                </thead>
                <tbody>


                @foreach($matches as $key=>$match)
                    <tr>
                        <td class="align-middle"><a href="{{route('matches.edit', $match->id)}}">{{$match->teams}}</a></td>

                        <td class="align-middle">
                            <div class="row">

                                <div class="row col-4 no-gutters">
                                    <label for="first_team_score" class="sr-only">{{__('messages.team')}}</label>
                                    <input type="text" class="form-control col-12 px-2 my-1" id="first_team_score"
                                           name="first_team_score"
                                           v-model="matches['{{$key}}'].first_team_score"
                                           v-on:input="changingScore({{$key}})">


                                    @for($counter=1; $counter<6; $counter++)
                                        <label for="first_team_score_{{$counter}}"
                                               class="sr-only">{{__('messages.team')}}</label>
                                        <input type="text" class="form-control col-2 my-1 ml-auto mr-auto px-2"
                                               id="first_team_score_{{$counter}}"
                                               name="first_team_score_{{$counter}}"
                                               v-model="matches['{{$key}}'].first_team_score_{{$counter}}"
                                               v-on:input="changingScore({{$key}})">
                                    @endfor

                                </div>

                                <div class="row col-4 no-gutters">
                                    <label for="second_team_score" class="sr-only">{{__('messages.team')}}</label>
                                    <input type="text" class="form-control col-12 px-2 my-1" id="second_team_score"
                                           name="second_team_score"
                                           v-model="matches['{{$key}}'].second_team_score"
                                           v-on:input="changingScore({{$key}})">


                                    @for($counter=1; $counter<6; $counter++)
                                        <label for="second_team_score_{{$counter}}"
                                               class="sr-only">{{__('messages.team')}}</label>
                                        <input type="text" class="form-control col-2 my-1 ml-auto mr-auto  px-2"
                                               id="second_team_score_{{$counter}}"
                                               name="second_team_score_{{$counter}}"
                                               v-model="matches['{{$key}}'].second_team_score_{{$counter}}"
                                               v-on:input="changingScore({{$key}})">
                                    @endfor
                                </div>

                                <div class="col-4 my-auto">
                                    <button type="submit" class="btn" id="submit{{$key}}"
                                            v-bind:class="isSaved[{{$key}}] ? 'btn-success' : 'btn-outline-success'"
                                            v-on:click="postData({{$key}})">
                                        Save
                                    </button>
                                </div>

                            </div>
                        </td>


                        <td class="align-middle">
                            <form method="POST" action="{{route('matches.destroy', $match->id)}}">
                                <input name="_method" type="hidden" value="DELETE">
                                @csrf

                                <button type="submit" class="btn btn-danger">
                                    {{__('messages.delete')}}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="row">
                <div class="ml-auto mr-auto">
                    {{ $matches->links() }}
                </div>
            </div>
        </div>
    @else
        <h1>{{__('messages.matches not exist')}}</h1>
    @endif

@endsection

@section('scripts')

    <script>

                @if(count($matches)>0)

        let match = new Vue({
                el: '#matches',
                delimiters: ['{%', '%}'],
                data: {
                    matches: matches.data,
                    isSaved: {}
                },
                created: function () { // Set first values to this.isSaved array
                    for (let key in this.matches) {
                        Vue.set(this.isSaved, key, true);
                    }
                },
                methods: {
                    postData(key) {

                        let myData = {
                            id: this.matches[key].id,
                            first_team_score: this.matches[key].first_team_score,
                            first_team_score_1: this.matches[key].first_team_score_1,
                            first_team_score_2: this.matches[key].first_team_score_2,
                            first_team_score_3: this.matches[key].first_team_score_3,
                            first_team_score_4: this.matches[key].first_team_score_4,
                            first_team_score_5: this.matches[key].first_team_score_5,
                            second_team_score: this.matches[key].second_team_score,
                            second_team_score_1: this.matches[key].second_team_score_1,
                            second_team_score_2: this.matches[key].second_team_score_2,
                            second_team_score_3: this.matches[key].second_team_score_3,
                            second_team_score_4: this.matches[key].second_team_score_4,
                            second_team_score_5: this.matches[key].second_team_score_5
                        };

                        axios.patch('/api/match', myData)
                            .then(response => {
                                Vue.set(this.isSaved, key, true);
                            })
                            .catch(e => console.log(e));
                    },
                    changingScore(key) {
                        Vue.set(this.isSaved, key, false);
                    }
                }
            });

                @endif

        let searchContainer = new Vue({
                delimiters: ['{%', '%}'],
                el: "#searchContainer",
                data: {
                    sportSelected: '{!! $request->sport_id ?? 0 !!}',
                    championshipSelected: '{!! $request->championship_id ?? 0 !!}',
                    seasonSelected: '{!! $request->season_id ?? 0 !!}',
                    matchdaySelected: '{!! $request->matchday_id ?? 0 !!}',
                    championships: '',
                    seasons: '',
                    matchdays: ''
                },
                mounted: function () {
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

