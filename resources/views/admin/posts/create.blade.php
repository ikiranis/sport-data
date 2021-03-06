@extends('layouts.admin')

@section('content')

    @include('includes.apiToken')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.insert post')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" id="user_id" name="user_id" value="{{$user_id}}">

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="title">{{__('messages.title')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.title')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="title" name="title"
                                       value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="description">{{__('messages.description')}}</label>
                                <textarea class="form-control" id="description" name="description"
                                          rows="2">{{old('description')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="body">{{__('messages.text')}}</label>
                                <textarea class="form-control" id="body" name="body" rows="15"></textarea>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="reference">{{__('messages.reference')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.reference')}}</span>
                                </div>
                                <input type="text" max="800" class="form-control col-10 px-2" id="reference"
                                       name="reference"
                                       value="{{old('reference')}}">
                            </div>

                            <div id="teamsContainer">
                                <div class="input-group mb-3 no-gutters">
                                    <label for="sport_id" class="sr-only">{{__('messages.sport')}}</label>
                                    <div class="input-group-prepend col-2">
                                        <span class="input-group-text w-100">{{__('messages.sport')}}</span>
                                    </div>
                                    <select class="form-control col-10 px-2" v-model="sportSelected" id="sport_id"
                                            name="sport_id">
                                        <option value="0"></option>
                                        @foreach($sports as $sport)
                                            <option value="{{$sport->id}}">
                                                {{$sport->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="input-group mb-3 no-gutters">
                                    <label for="teams_selected" class="sr-only">{{__('messages.team')}}</label>
                                    <div class="input-group-prepend col-2">
                                        <span class="input-group-text w-100">{{__('messages.team')}}</span>
                                    </div>

                                    <input type="hidden" v-for="team in teamsSelected" name="teams_selected[]"
                                           :value="team.id">
                                    <select multiple class="form-control col-10 px-2" v-model="teamsSelected" style="height: 20em"
                                            ref="teamSelector"
                                            id="teams_selected" size="15">
                                        <option value="0" disabled></option>
                                        <option v-for="team in teams" :value="{id:team.id, text: team.name}"
                                                @mousedown.prevent="toggleOption">
                                            {% team.name %}
                                        </option>
                                    </select>
                                </div>

                                <div class="my-2 row">
                                    <span class="my-1 mx-2 px-2 bg-primary text-light" v-for="team in teamsSelected">{% team.text %}</span>
                                </div>

                                <div class="input-group mb-3 no-gutters">
                                    <label class="sr-only" for="tag">Tag</label>
                                    <div class="input-group-prepend col-2">
                                        <span class="input-group-text w-100">Tag</span>
                                    </div>
                                    <input type="text" max="255" v-model="tag" class="form-control col-8 px-2"
                                           id="tag" name="tag">

                                    <span class="btn btn-success col-2" v-on:click="insertTag">Προσθήκη</span>

                                    <input type="hidden" v-for="tag in tags" name="tags[]" :value="tag.id">

                                </div>

                                <div class="my-2 row">
                                    <span class="my-1 mx-2 px-2 bg-primary text-light" v-for="tag in tags">{% tag.name %}</span>
                                </div>

                            </div>


                            <div class="input-group mb-3 no-gutters">
                                <label for="athlete_id" class="sr-only">{{__('messages.athlete')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.athlete')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="athlete_id" name="athlete_id">
                                    <option value="0"></option>
                                    @foreach($athletes as $athlete)
                                        <option value="{{$athlete->id}}">
                                            {{$athlete->fullName}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row my-3 border">

                                <div class="form-group my-3 col-lg-6 col-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="uploadFile"
                                               id="uploadFile"
                                               accept='image/*'>
                                        <label class="custom-file-label"
                                               for="customFile">{{__('messages.picture')}}</label>
                                    </div>
                                </div>

                                <div class="input-group my-3 col-lg-6 col-12">
                                    <label class="sr-only"
                                           for="photo_reference">{{__('messages.reference')}}</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{__('messages.reference')}}</span>
                                    </div>
                                    <input type="text" max="800" class="form-control" id="photo_reference"
                                           name="photo_reference"
                                           value="{{old('photo_reference')}}">
                                </div>

                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="author">Όνομα</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Όνομα</span>
                                </div>
                                <input type="text" max="25" class="form-control col-10 px-2" id="author"
                                       name="author"
                                       value="{{old('author')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters my-2">
                                <label for="approved" class="sr-only">{{__('messages.approve')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100 bg-warning">{{__('messages.approve')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="approved" name="approved">
                                    <option value="0">{{__('messages.inactive')}}</option>
                                    <option value="1" selected>{{__('messages.active')}}</option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
                                    {{__('messages.insert')}}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.editor')

@endsection

@section('scripts')

    <script>

        let teamTags = new Vue({
            el: '#teamsContainer',
            delimiters: ['{%', '%}'],
            data: {
                teams: {!! json_encode($teams) !!},
                sportSelected: 0,
                // championshipSelected: '',
                // divisionSelected: 0,
                teamsSelected: [],
                tags: [],
                tag: ''
            },
            methods: {
                toggleOption(e) {
                    this.$refs.teamSelector.focus();
                    e.target.selected = !e.target.selected;
                    e.target.parentElement.dispatchEvent(new Event('change'));
                },
                insertTag(e) {

                    let myData = {
                        name: this.tag
                    };

                    axios.post('/api/tag', myData)
                        .then(response => {
                            this.tags.push({id: response.data.id, name: response.data.name});
                            this.tag = '';
                        })
                        .catch(e => console.log(e));

                }
            }
        });

    </script>

@endsection

