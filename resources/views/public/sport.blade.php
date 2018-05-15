@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : {{$sport->name}}
@endsection

@section('content')
    <h1 class="text-center">{{$sport->name}}</h1>

    <div class="container">

        @if(count($championships)>0)

            <form method="GET" action="{{route('standings')}}">

                @csrf

                <div class="container w-100" id="searchContainer">
                    <div class="row">
                        <div class="col-lg-4 col-12 my-1">
                            <label for="championship_id" class="sr-only">Πρωτάθλημα</label>
                            <select class="form-control px-2" v-on:change="getSeasons()"
                                    v-model="championshipSelected"
                                    id="championship_id" name="championship_id">
                                <option value="0" disabled>Πρωτάθλημα</option>
                                @foreach($championships as $championship)
                                    <option value="{{$championship->id}}">
                                        {{$championship->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-12 my-1">
                            <label for="season_id" class="sr-only">Season</label>
                            <select v-model="seasonSelected"
                                    class="form-control px-2"
                                    id="season_id" name="season_id">
                                <option value="0" disabled>Επιλογή</option>
                                <option v-for="season in seasons" :value="season.id">{% season.name %}</option>
                            </select>
                        </div>

                        <div class="col-lg-4 col-12 my-1">
                            <button type="submit" class="btn btn-info w-100">
                                Βαθμολογία / Αποτελέσματα
                            </button>
                        </div>
                    </div>
                </div>

            </form>

        @endif

        @if(count($posts)>0)

            @foreach($posts as $post)

                @include('includes.post-list')

            @endforeach

            <div class="row">
                <div class="ml-auto mr-auto">
                    {{ $posts->links() }}
                </div>
            </div>

        @endif
    </div>

@endsection

@section('scripts')

    @if(count($posts)>0)
        @foreach($posts as $post)
            @if(count($post->teams()->get())>0)
                @include('includes.teams-container-javascript')
            @endif
        @endforeach
    @endif


    <script>

        let searchContainer = new Vue({
            delimiters: ['{%', '%}'],
            el: "#searchContainer",
            data: {
                championshipSelected: 0,
                seasonSelected: 0,
                seasons: ''
            },
            mounted: function () {
                this.getSeasons();
            },
            methods: {
                getSeasons() {
                    axios.get('/api/seasons/' + this.championshipSelected)
                        .then(response => {
                            this.seasons = response.data;
                            if (this.seasons.length > 0) {
                                this.seasonSelected = this.seasons[0].id;
                            }
                        })
                        .catch(e => console.log(e));
                }
            }
        });


    </script>

@endsection
