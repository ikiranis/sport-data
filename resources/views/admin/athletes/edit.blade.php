@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.update athlete')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('athletes.update', $athlete->id) }}"
                              enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="fname">{{__('messages.name')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" class="form-control col-9 px-2" id="fname" name="fname"
                                       max="255" value="{{$athlete->fname}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="lname">{{__('messages.lname')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.lname')}}</span>
                                </div>
                                <input type="text" class="form-control col-9 px-2" id="lname" name="lname"
                                       max="255" value="{{$athlete->lname}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="birthyear">{{__('messages.birthyear')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.birthyear')}}</span>
                                </div>
                                <input type="number" class="form-control col-9 px-2" id="birthyear" name="birthyear"
                                       min="1930" max="2030" value="{{$athlete->birthyear}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="city">{{__('messages.city')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.city')}}</span>
                                </div>
                                <input type="text" class="form-control col-9 px-2" id="city" name="city"
                                       max="255" value="{{$athlete->city}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="country">{{__('messages.country')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.country')}}</span>
                                </div>
                                <input type="text" class="form-control col-9 px-2" id="country" name="country"
                                       max="255" value="{{$athlete->country}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="height">{{__('messages.height')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.height')}}</span>
                                </div>
                                <input type="number" class="form-control col-9 px-2" id="height" name="height"
                                       min="100" max="230" value="{{$athlete->height}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="sport_id" class="sr-only">{{__('messages.sport')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.sport')}}</span>
                                </div>
                                <select class="form-control col-9 px-2" id="sport_id" name="sport_id">
                                    @foreach($sports as $sport)
                                        <option value="{{$sport->id}}" {{$sport->id==$athlete->sport_id ? 'selected' : ''}}>
                                            {{$sport->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row border p-2">

                                <div class="col-lg-5">
                                    <img src="{{$athlete->photo ? $athlete->photo->fullPathName : 'http://via.placeholder.com/350x350'}}"
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
                                        <label class="sr-only" for="reference">{{__('messages.reference')}}</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{__('messages.reference')}}</span>
                                        </div>
                                        <input type="text" class="form-control" id="reference" name="reference"
                                               max="255" value="{{$athlete->photo ? $athlete->photo->reference : ''}}">
                                    </div>

                                </div>

                            </div>

                            <div class="form-group row my-3">
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


@endsection
