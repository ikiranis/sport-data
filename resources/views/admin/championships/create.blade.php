@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.insert championship')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('championships.store') }}">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="name">{{__('messages.name')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="name" name="name">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="sport_id" class="sr-only">{{__('messages.sport')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.sport')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="sport_id" name="sport_id">
                                    @foreach($sports as $sport)
                                        <option value="{{$sport->id}}">
                                            {{$sport->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters my-2">
                                <label for="has_standings" class="sr-only">Βαθμολογία</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Βαθμολογία</span>
                                </div>
                                <select class="form-control col-10 px-2" id="has_standings" name="has_standings">
                                    <option value="0">Όχι</option>
                                    <option value="1" selected>Ναι</option>
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


@endsection


