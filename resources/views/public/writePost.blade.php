@extends('layouts.app')

@section('siteTitle')
    {{ config('app.name', 'Laravel') }} : Αποστολή είδησης
@endsection

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Αποστολή είδησης</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('storePost') }}">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="title">{{__('messages.title')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.title')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="title" name="title"
                                       value="{{old('title')}}">
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="body">{{__('messages.text')}}</label>
                                <textarea class="form-control" id="body" name="body" rows="10">{{old('body')}}</textarea>
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

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="reference">{{__('messages.reference')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.reference')}}</span>
                                </div>
                                <input type="text" max="800" class="form-control col-10 px-2" id="reference"
                                       name="reference"
                                       value="{{old('reference')}}">
                            </div>

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

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
                                    Αποστολή
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection