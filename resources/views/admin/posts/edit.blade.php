@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.update post')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.update', $post->id) }}"
                              enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="title">{{__('messages.title')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.title')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="title" name="title"
                                       value="{{$post->title}}">
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="description">{{__('messages.description')}}</label>
                                <textarea class="form-control" id="description" name="description"
                                          rows="2">{{$post->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="body">{{__('messages.text')}}</label>
                                <div id="toolbar-container"></div>
                                <textarea class="form-control ckeditor" id="body" name="body">{{ $post->body }}</textarea>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="reference">{{__('messages.reference')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.reference')}}</span>
                                </div>
                                <input type="text" max="800" class="form-control col-10 px-2" id="reference"
                                       name="reference" value="{{$post->reference}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="sport_id" class="sr-only">{{__('messages.sport')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.sport')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="sport_id" name="sport_id">
                                    <option value="0"></option>
                                    @foreach($sports as $sport)
                                        <option value="{{$sport->id}}" {{$sport->id==$post->sport_id ? 'selected' : ''}}>
                                            {{$sport->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="teamsContainer">
                                <div class="input-group mb-3 no-gutters">
                                    <label for="teams_selected" class="sr-only">{{__('messages.team')}}</label>
                                    <div class="input-group-prepend col-2">
                                        <span class="input-group-text w-100">{{__('messages.team')}}</span>
                                    </div>

                                    <input type="hidden" v-for="team in teamsSelected" name="teams_selected[]"
                                           :value="team.id">
                                    <select multiple class="form-control col-10 px-2" v-model="teamsSelected"
                                            ref="teamSelector"
                                            id="teams_selected">
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
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="athlete_id" class="sr-only">{{__('messages.athlete')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.athlete')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="athlete_id" name="athlete_id">
                                    <option value="0"></option>
                                    @foreach($athletes as $athlete)
                                        <option value="{{$athlete->id}}" {{$athlete->id==$post->athlete_id ? 'selected' : ''}}>
                                            {{$athlete->fullName}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row border p-2">

                                <div class="col-lg-5">
                                    <img src="{{$post->photo ? $post->photo->fullPathName : 'http://via.placeholder.com/350x350'}}"
                                         class="img-fluid">
                                </div>

                                <div class="col-lg-7 col-12 my-auto">

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="uploadFile"
                                                   id="uploadFile"
                                                   accept='image/*'>
                                            <label class="custom-file-label"
                                                   for="customFile">{{__('messages.picture')}}</label>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <label class="sr-only"
                                               for="photo_reference">{{__('messages.reference')}}</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{__('messages.reference')}}</span>
                                        </div>
                                        <input type="text" max="800" class="form-control"
                                               id="photo_reference" name="photo_reference"
                                               value="{{$post->photo ? $post->photo->reference : ''}}">
                                    </div>

                                </div>

                            </div>

                            <div class="input-group mb-3 no-gutters my-2">
                                <label for="approved" class="sr-only">{{__('messages.approve')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100 bg-warning">{{__('messages.approve')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="approved" name="approved">
                                    <option value="0" {{$post->approved==0 ? 'selected' : ''}}>{{__('messages.inactive')}}</option>
                                    <option value="1" {{$post->approved==1 ? 'selected' : ''}}>{{__('messages.active')}}</option>
                                </select>
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

    @include('includes.editor')

@endsection


@section('scripts')

    <script>

        let teamTags = new Vue({
            el: '#teamsContainer',
            delimiters: ['{%', '%}'],
            data: {
                teams: {!! json_encode($teams) !!},
                teamsSelected: {!!
                    json_encode($post->teams()->get()->map(function($item) {
                        return ['id' => $item->id, 'text' => $item->name];
                    }))
                !!}
            },
            methods: {
                toggleOption(e) {
                    this.$refs.teamSelector.focus();
                    e.target.selected = !e.target.selected;
                    e.target.parentElement.dispatchEvent(new Event('change'));
                }
            }
        });

    </script>

@endsection




