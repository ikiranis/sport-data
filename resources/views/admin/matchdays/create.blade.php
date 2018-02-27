@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.insert matchday')}}</h1>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.insert matchday')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('matchdays.store') }}">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="matchday">{{trans_choice('messages.matchdays',1)}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{trans_choice('messages.matchdays',1)}}</span>
                                </div>
                                <input type="text" class="form-control col-10 px-2" id="matchday" name="matchday">
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
