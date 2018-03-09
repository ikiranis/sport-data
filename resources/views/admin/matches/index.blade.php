@extends('layouts.admin')

@section('content')

    <h1>{{trans_choice('messages.matches',2)}}</h1>

    <form method="GET" action="{{route('matches.index')}}">
        <div class="row">

            @csrf

            <div class="input-group mb-3 no-gutters col-lg-3 col-12 my-1">
                <label for="sport_id" class="sr-only">{{__('messages.sport')}}</label>
                <div class="input-group-prepend col-5">
                    <span class="input-group-text w-100">{{__('messages.sport')}}</span>
                </div>
                <select class="form-control col-7 px-2" id="sport_id" name="sport_id">
                    @foreach($sports as $sport)
                        <option value="{{$sport->id}}">
                            {{$sport->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3 no-gutters col-lg-3 col-12 my-1">
                <label for="championship_id" class="sr-only">Championship</label>
                <div class="input-group-prepend col-5">
                    <span class="input-group-text w-100">Championship</span>
                </div>
                <select class="form-control col-7 px-2" id="championship_id" name="championship_id">
                    @foreach($championships as $championship)
                        <option value="{{$championship->id}}">
                            {{$championship->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="input-group mb-3 no-gutters col-lg-3 col-12 my-1">
                <label for="season_id" class="sr-only">Season</label>
                <div class="input-group-prepend col-5">
                    <span class="input-group-text w-100">Season</span>
                </div>
                <select class="form-control col-7 px-2" id="season_id" name="season_id">
                    @foreach($seasons as $season)
                        <option value="{{$season->id}}">
                            {{$season->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3 col-12 my-1">
                <button type="submit" class="btn btn-success w-100">
                    {{__('messages.search')}}
                </button>
            </div>

        </div>
    </form>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('matches.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert match')}}</button>
        </a>
    </div>


    @if(count($matches)>0)
        <script>
            let matches = {!! json_encode($matches) !!};
        </script>

        <div id="matches">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{trans_choice('messages.matches',1)}}</th>
                    <th scope="col">{{__('messages.score')}}</th>
                    <th scope="col">{{__('messages.action')}}</th>
                </tr>
                </thead>
                <tbody>


                @foreach($matches as $key=>$match)
                    <tr>
                        <th scope="row">{{$match->id}}</th>
                        <td><a href="{{route('matches.edit', $match->id)}}">{{$match->teams}}</a></td>

                        <td>
                            <div class="row">

                                <label for="first_team_score" class="sr-only">{{__('messages.team')}}</label>
                                <input type="text" class="form-control col-4 px-2" id="first_team_score"
                                       name="first_team_score"
                                       v-model="matches[{{$key}}].first_team_score"
                                       v-on:click="changingScore()">

                                <label for="second_team_score" class="sr-only">{{__('messages.team')}}</label>
                                <input type="text" class="form-control col-4 px-2" id="second_team_score"
                                       name="second_team_score"
                                       v-model="matches[{{$key}}].second_team_score"
                                       v-on:click="changingScore()">

                                <div class="col-4">
                                    <button type="submit" class="btn"
                                            v-bind:class="{ 'btn-success': isSaved, 'btn-outline-info': notSaved }"
                                            v-on:click="postData({{$key}})">
                                        Save
                                    </button>
                                </div>

                            </div>
                        </td>


                        <td>
                            <form method="POST" action="{{route('matchdays.destroy', $match->id)}}">
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

    <div id="testVue">
        <ol>
            <!--
              Now we provide each todo-item with the todo object
              it's representing, so that its content can be dynamic.
              We also need to provide each component with a "key",
              which will be explained later.
            -->
            <todo-item
                    v-for="item in groceryList"
                    v-bind:todo="item"
                    v-bind:key="item.id">
            </todo-item>
        </ol>
    </div>

@endsection

@section('scripts')

    <script>

        const match = new Vue({
            el: '#matches',
            data: {
                matches: matches.data,
                isSaved: false,
                notSaved: true
            },
            methods: {
                postData(key) {

                    let myData = {
                        first_team_score: this.matches[key].first_team_score,
                        second_team_score: this.matches[key].second_team_score
                    };

                    axios.put('/admin/matches/score/' + this.matches[key].id, myData)
                        .then(response => {
                            this.isSaved = true;
                            this.notSaved = false;
                            console.log(response)
                        })
                        .catch(e => console.log(e) );
                },
                changingScore() {
                    this.isSaved = false;
                    this.notSaved = true;
                }
            }
        });

    </script>

    <script src="{{ mix('js/test.js') }}"></script>

@endsection
