@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.insert season')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('seasons.store') }}">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="name">{{__('messages.name')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="name" name="name">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="championship_id" class="sr-only">{{__('messages.championship')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.championship')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="championship_id" name="championship_id">
                                    @foreach($championships as $championship)
                                        <option value="{{$championship->id}}">
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
                                        <option value="{{$rule->id}}">
                                            {{$rule->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label for="matchdays_number" class="sr-only">Αγωνιστικές</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">Αγωνιστικές</span>
                                </div>
                                <select class="form-control col-10 px-2" id="matchdays_number" name="matchdays_number">
                                    @for($counter=1; $counter<40; $counter++)
                                        <option value="{{ $counter }}">
                                            {{ $counter }}
                                        </option>
                                    @endfor
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
