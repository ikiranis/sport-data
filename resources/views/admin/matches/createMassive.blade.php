@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">

        <div id="matches">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">{{trans_choice('messages.matches',1)}}</th>
                    <th scope="col">{{__('messages.date')}}</th>
                    <th scope="col">{{__('messages.stadium')}}</th>
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
                                <select class="form-control col-10 px-2" id="stadium_id" name="stadium_id">
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
                                <input type="date" class="form-control col-10 px-2" id="match_date" name="match_date">
                            </div>

                        </td>


                        <td>
                            <form method="POST" action="">
                                <input name="_method" type="hidden" value="DELETE">
                                @csrf

                                <button type="submit" class="btn btn-danger">
                                    Save
                                </button>
                            </form>
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
                    teams: @json($teams)
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
                    }
                }
            });
        @endfor

    </script>

@endsection
