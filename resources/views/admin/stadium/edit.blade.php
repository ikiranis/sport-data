@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.update stadium')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('stadium.update', $stadium->id) }}">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="name">{{__('messages.name')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="name" name="name" value="{{$stadium->name}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="city">{{__('messages.city')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.city')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="city" name="city" value="{{$stadium->city}}">
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


@endsection
