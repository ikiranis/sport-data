@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.edit sport')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('sports.update', $sport->id) }}" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3">
                                <label class="sr-only" for="name">{{__('messages.name')}}</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control" id="name" name="name" value="{{$sport->name}}">
                            </div>

                            <div class="row border p-2">

                                <div class="col-lg-5">
                                    <img src="{{$sport->photo ? $sport->photo->fullPathName : 'http://via.placeholder.com/350x350'}}" class="img-fluid">
                                </div>

                                <div class="col-lg-7 col-12 my-auto">

                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="uploadFile" id="uploadFile"
                                                   accept='image/*'>
                                            <label class="custom-file-label" for="customFile">{{__('messages.picture')}}</label>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <label class="sr-only" for="reference">{{__('messages.reference')}}</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{__('messages.reference')}}</span>
                                        </div>
                                        <input type="text" class="form-control" id="reference" name="reference"
                                               max="255" value="{{$sport->photo ? $sport->photo->reference : ''}}">
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
