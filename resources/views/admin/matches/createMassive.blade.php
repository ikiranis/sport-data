@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">

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
                                       v-model="matches['{{$key}}'].first_team_score"
                                       v-on:input="changingScore({{$key}})">

                                <label for="second_team_score" class="sr-only">{{__('messages.team')}}</label>
                                <input type="text" class="form-control col-4 px-2" id="second_team_score"
                                       name="second_team_score"
                                       v-model="matches['{{$key}}'].second_team_score"
                                       v-on:input="changingScore({{$key}})">

                                <div class="col-4">
                                    <button type="submit" class="btn" id="submit{{$key}}"
                                            v-bind:class="isSaved[{{$key}}] ? 'btn-success' : 'btn-outline-success'"
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
    </div>


@endsection

@section('scripts')

    <script>



    </script>

@endsection
