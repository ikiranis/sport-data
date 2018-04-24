@extends('layouts.admin')

@section('content')

    <h1>{{__('messages.standings')}}</h1>

    <div id="searchContainer">
        <form method="GET">
            @csrf

            <div class="row">
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
                    <select v-on:change="getSeasons()" v-model="championshipSelected"
                            class="form-control col-7 px-2"
                            id="championship_id" name="championship_id">
                        <option value="0" disabled>Επιλογή</option>
                        <option v-for="championship in championships" :value="championship.id">{% championship.name
                            %}
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

                <div class="col-lg-3 col-12 my-1">
                    <button type="submit" class="btn btn-success w-100" formaction="{{route('matches.index')}}">
                        {{__('messages.search')}}
                    </button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
                    <button type="submit" class="btn btn-info w-100" formaction="{{route('matches.create')}}">
                        {{__('messages.insert match')}}
                    </button>
                </div>

                <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
                    <button type="submit" class="btn btn-info w-100"
                            formaction="{{route('matches.create.massive')}}">
                        {{__('messages.insert matches')}}
                    </button>
                </div>
            </div>

        </form>


    </div>


    @if(!$teamsStandings == null)

        <div id="teams">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Ομάδα</th>
                    <th scope="col">Βαθμολογία</th>
                </tr>
                </thead>
                <tbody>


                @foreach($teamsStandings as $team)
                    <tr>
                        <th>{{$team->team}}</th>
                        <td>{{$team->points}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    @else
        <h1>{{__('messages.teams not exist')}}</h1>
    @endif

@endsection

@section('scripts')

    <script>

        let searchContainer = new Vue({
                delimiters: ['{%', '%}'],
                el: "#searchContainer",
                data: {
                    sportSelected: '{!! $request->sport_id ?? 0 !!}',
                    championshipSelected: '{!! $request->championship_id ?? 0 !!}',
                    seasonSelected: '{!! $request->season_id ?? 0 !!}',
                    championships: '',
                    seasons: ''
                },
                mounted: function () {
                    this.getChampionships();
                    this.getSeasons();
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
                    }
                }
            });


    </script>

@endsection

