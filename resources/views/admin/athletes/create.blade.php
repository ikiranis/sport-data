@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.insert athlete')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('athletes.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="fname">{{__('messages.name')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-9 px-2" id="fname" name="fname"
                                placeholder="{{old('fname')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="lname">{{__('messages.lname')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.lname')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-9 px-2" id="lname" name="lname"
                                       placeholder="{{old('lname')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="birthyear">{{__('messages.birthyear')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.birthyear')}}</span>
                                </div>
                                <input type="number" min="1930" max="2030" class="form-control col-9 px-2" id="birthyear" name="birthyear"
                                       placeholder="{{old('birthyear')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="city">{{__('messages.city')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.city')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-9 px-2" id="city" name="city"
                                       placeholder="{{old('city')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="country">{{__('messages.country')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.country')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-9 px-2" id="country" name="country"
                                       placeholder="{{old('country')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="height">{{__('messages.height')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.height')}}</span>
                                </div>
                                <input type="number" class="form-control col-9 px-2" min="100" max="230" id="height" name="height"
                                       placeholder="{{old('height')}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="sport_id" class="sr-only">{{__('messages.sport')}}</label>
                                <div class="input-group-prepend col-3">
                                    <span class="input-group-text w-100">{{__('messages.sport')}}</span>
                                </div>
                                <select class="form-control col-9 px-2" id="sport_id" name="sport_id">
                                    @foreach($sports as $sport)
                                        <option value="{{$sport->id}}">
                                            {{$sport->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row my-3 border">

                                <div class="form-group my-3 col-lg-6 col-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="uploadFile" id="uploadFile"
                                               accept='image/*'>
                                        <label class="custom-file-label" for="customFile">{{__('messages.picture')}}</label>
                                    </div>
                                </div>

                                <div class="input-group my-3 col-lg-6 col-12">
                                    <label class="sr-only" for="reference">{{__('messages.reference')}}</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">{{__('messages.reference')}}</span>
                                    </div>
                                    <input type="text" max="255" class="form-control" id="reference" name="reference"
                                           placeholder="{{old('reference')}}">
                                </div>

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


@endsection
