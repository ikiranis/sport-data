@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">

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

                @for($counter=0; $counter<(count($teams)/2); $counter++)
                    <tr id="matchesContainer{{$counter}}">

                            <td>

                                <div class="input-group mb-3 no-gutters">
                                    <label for="first_team_id" class="sr-only">{{__('messages.team')}}</label>
                                    <select v-model="firstTeamSelected" v-on:change="checkValidTeam"
                                            class="form-control col-5 px-2"
                                            id="first_team_id" name="first_team_id">
                                        <option value="0"></option>
                                        <option v-for="team in teams" :value="team.id">{% team.name %}</option>
                                    </select>

                                    <label for="second_team_id" class="sr-only">{{__('messages.team')}}</label>
                                    <select v-model="secondTeamSelected" v-on:change="checkValidTeam"
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
                                    <select v-model="stadiumSelected" class="form-control col-10 px-2" id="stadium_id" name="stadium_id">
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
                                <button v-on:click="postData" type="submit" class="btn"
                                        v-bind:class="isSaved ? 'btn-success' : 'btn-outline-success'"
                                        v-bind:disabled="isSaved">
                                    Save
                                </button>
                            </td>
                    </tr>
                @endfor

                </tbody>
            </table>

        </div>
    </div>


@endsection

@section('scripts')

    <script>

        function getIndexInArray(haystack, needle) {
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


        @for($counter=0; $counter<(count($teams)/2); $counter++)
        new Vue({
            delimiters: ['{%', '%}'],
            el: "#matchesContainer{{$counter}}",
            data: {
                firstTeamSelected: '{!! $data->first_team_id ?? 0 !!}',
                secondTeamSelected: '{!! $data->second_team_id ?? 0 !!}',
                teams: @json($teams),
                sport_id: '{!! $data->sport_id ?? 0 !!}',
                championship_id: '{!! $data->championship_id ?? 0 !!}',
                season_id: '{!! $data->season_id ?? 0 !!}',
                matchday_id: '{!! $data->matchday_id ?? 0 !!}',
                stadiumSelected: '',
                isSaved: false
            },
            methods: {
                checkValidTeam(e) { // Check if the other team is the same
                    if (this.firstTeamSelected === this.secondTeamSelected) {

                        let changedSelectElement = e.target.id;

                        if (changedSelectElement === 'first_team_id') {
                            this.firstTeamSelected = this.teams[getIndexInArray(this.teams, this.firstTeamSelected)].id;
                        } else {
                            this.secondTeamSelected = this.teams[getIndexInArray(this.teams, this.secondTeamSelected)].id;
                        }

                    }
                },
                postData() {

                    let myData = {
                        sport_id: this.sport_id,
                        championship_id: this.championship_id,
                        season_id: this.season_id,
                        matchday_id: this.matchday_id,
                        first_team_id: this.firstTeamSelected,
                        second_team_id: this.secondTeamSelected,
                        stadium_id: this.stadiumSelected
                    };

                    axios.post('/api/match', myData)
                        .then(response => {
                            this.isSaved = true;
                        })
                        .catch(e => console.log(e));
                },
            }
        });
        @endfor

    </script>

@endsection
