@extends('layouts.admin')

@section('content')

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
                                <input type="text" class="form-control col-10 px-2" id="title" name="title"
                                       value="{{$post->title}}">
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="description">{{__('messages.description')}}</label>
                                <textarea class="form-control" id="description" name="description" rows="2">{{$post->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="body">{{__('messages.text')}}</label>
                                <textarea class="form-control ckeditor" id="body" name="body">{{$post->body}}</textarea>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="reference">{{__('messages.reference')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.reference')}}</span>
                                </div>
                                <input type="text" class="form-control col-10 px-2" id="reference"
                                       name="reference" {{$post->reference}}>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="sport_id" class="sr-only">{{__('messages.sport')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.sport')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="sport_id" name="sport_id">
                                    @foreach($sports as $sport)
                                        <option value="{{$sport->id}}" {{$sport->id==$post->sport_id ? 'selected' : ''}}>
                                            {{$sport->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="team_id" class="sr-only">{{__('messages.team')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.team')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="team_id" name="team_id">
                                    @foreach($teams as $team)
                                        <option value="{{$team->id}}" {{$team->id==$post->team_id ? 'selected' : ''}}>
                                            {{$team->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="athlete_id" class="sr-only">{{__('messages.athlete')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.athlete')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="athlete_id" name="athlete_id">
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
                                        <input type="text" class="form-control" id="photo_reference"
                                               name="photo_reference"
                                               value="{{$post->photo ? $post->photo->reference : ''}}">
                                    </div>

                                </div>

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

    <script>
        ClassicEditor
            .create(document.querySelector('.ckeditor') )
            .catch(error => {
                console.error(error);
            });
    </script>


@endsection

@include('includes.editor')






