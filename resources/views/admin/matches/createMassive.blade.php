@extends('layouts.admin')

@section('content')

    <h1>{{trans_choice('messages.matches',2)}}</h1>

    <div class="container">

        @if(!$matches>0)
            <div id="matches">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">{{trans_choice('messages.matches',1)}}</th>
                        <th scope="col">{{__('messages.stadium')}}</th>
                        <th scope="col">{{__('messages.date')}}</th>
                        <th scope="col">{{__('messages.action')}}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @for($key=0; $key<(count($teams)/2); $key++)
                        <tr>

                            <td>

                                <div class="input-group mb-3 no-gutters">
                                    <label for="first_team_id" class="sr-only">{{__('messages.team')}}</label>
                                    <select v-model="firstTeamSelected['{{$key}}']"
                                            v-on:change="checkValidTeam($event, {{$key}})"
                                            class="form-control col-5 px-2"
                                            id="first_team_id" name="first_team_id">
                                        <option value="0"></option>
                                        <option v-for="team in teams" :value="team.id">{% team.name %}</option>
                                    </select>

                                    <label for="second_team_id" class="sr-only">{{__('messages.team')}}</label>
                                    <select v-model="secondTeamSelected['{{$key}}']"
                                            v-on:change="checkValidTeam($event, {{$key}})"
                                            class="form-control col-5 px-2"
                                            id="second_team_id" name="second_team_id">
                                        <option value="0"></option>
                                        <option v-for="team in teams" :value="team.id">{% team.name %}</option>
                                    </select>
                                </div>

                            </td>

                            <td>
                                <div class="input-group mb-3 no-gutters">
                                    <label for="stadium_id" class="sr-only">{{__('messages.stadium')}}</label>
                                    <select v-model="stadiumSelected['{{$key}}']" class="form-control col-10 px-2"
                                            id="stadium_id"
                                            name="stadium_id">
                                        @foreach($stadia as $stadium)
                                            <option value="{{$stadium->id}}">
                                                {{$stadium->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>

                            <td>
                                <div class="input-group mb-3 no-gutters">
                                    <label class="sr-only" for="match_date">{{__('messages.date')}}</label>
                                    <input type="date" class="form-control col-10 px-2" id="match_date"
                                           name="match_date">
                                </div>

                            </td>


                            <td>
                                <button v-on:click="postData({{$key}})" type="submit" class="btn"
                                        v-bind:class="isSaved[{{$key}}] ? 'btn-success' : 'btn-outline-success'">
                                    {% isSaved['{{$key}}'] ? 'Ενημέρωση' : 'Αποθήκευση' %}
                                </button>
                            </td>
                        </tr>
                    @endfor

                    </tbody>
                </table>

            </div>
    </div>

    @else
        <h1>Υπάρχουν ήδη αγώνες σε αυτή την αγωνιστική</h1>
    @endif


@endsection

@section('scripts')

    <script>

        /**
         * Get the index position of needle in haystack array
         *
         * @param haystack {array}
         * @param needle
         * @returns {number}
         */
        function getIndexInArray(haystack, needle)
        {
            // TODO find better way with for/in
            // TODO put function at basic library
            for (let i = 0; i < haystack.length; i++) {
                if (haystack[i].id === needle) {
                    if (i === haystack.length - 1) {
                        return 0;
                    } else {
                        return i + 1;
                    }

                }
            }
        }

        /**
         * Count how many times needle is in haystack array
         *
         * @param haystack
         * @param needle
         * @returns {number}
         */
        function countArrayContains(haystack, needle)
        {
            return haystack.filter(function(x){
                return x === needle;
            }).length;
        }

        new Vue({
            delimiters: ['{%', '%}'],
            el: "#matches",
            data: {
                firstTeamSelected: [],
                secondTeamSelected: [],
                teamsSelected: [],
                teams: @json($teams),
                sport_id: '{!! $data->sport_id ?? 0 !!}',
                championship_id: '{!! $data->championship_id ?? 0 !!}',
                season_id: '{!! $data->season_id ?? 0 !!}',
                matchday_id: '{!! $data->matchday_id ?? 0 !!}',
                stadiumSelected: [],
                isSaved: [],
                match_id: []
            },
            created: function () { // Set first values to this.isSaved array
                for (let i = 0; i < (this.teams.length / 2); i++) {
                    Vue.set(this.isSaved, i, false);
                }
            },
            methods: {
                checkValidTeam(e, key) { // Check if the other team is the same
                    this.teamsSelected = this.firstTeamSelected.concat(this.secondTeamSelected);

                    let countFirstTeamContains = countArrayContains(this.teamsSelected, this.firstTeamSelected[key]);
                    let countSecondTeamContains = countArrayContains(this.teamsSelected, this.secondTeamSelected[key]);

                    if (countFirstTeamContains > 1 || countSecondTeamContains > 1) {

                        let changedSelectElement = e.target.id;

                        if (changedSelectElement === 'first_team_id') {
                            this.firstTeamSelected[key] = 0;
                        } else {
                            this.secondTeamSelected[key] = 0;
                        }

                    }
                },
                postData(key) {

                    let myData = {
                        id: this.match_id[key],
                        sport_id: this.sport_id,
                        championship_id: this.championship_id,
                        season_id: this.season_id,
                        matchday_id: this.matchday_id,
                        first_team_id: this.firstTeamSelected[key],
                        second_team_id: this.secondTeamSelected[key],
                        stadium_id: this.stadiumSelected[key]
                    };

                    if(this.isSaved[key]) {
                        axios.patch('/api/match', myData)
                            .then(response => {
                                Vue.set(this.isSaved, key, true);
                            })
                            .catch(e => console.log(e));
                    } else {
                        axios.post('/api/match', myData)
                            .then(response => {
                                Vue.set(this.match_id, key, response.data.id);
                                Vue.set(this.isSaved, key, true);
                            })
                            .catch(e => console.log(e));
                    }


                },
            }
        });


    </script>

@endsection
