@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.update season')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('seasons.update', $season->id) }}">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="name">{{__('messages.name')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="name" name="name" value="{{$season->name}}">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="championship_id" class="sr-only">{{__('messages.championship')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.championship')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="championship_id" name="championship_id">
                                    @foreach($championships as $championship)
                                        <option value="{{$championship->id}}" {{$championship->id==$season->championship_id ? 'selected' : ''}}>
                                            {{$championship->name}} : {{ $championship->sport->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="rule_id" class="sr-only">Κανόνες</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Κανόνες</span>
                                </div>
                                <select class="form-control col-10 px-2" id="rule_id" name="rule_id">
                                    @foreach($rules as $rule)
                                        <option value="{{$rule->id}}" {{$rule->id==$season->rule_id ? 'selected' : ''}}>
                                            {{$rule->name}}
                                        </option>
                                    @endforeach
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


@endsection
