@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.insert rule')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('rules.store') }}">
                            @csrf

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="name">{{__('messages.name')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                                </div>
                                <input type="number" min="0" max="100" class="form-control col-10 px-2" id="name"
                                       name="name">
                            </div>

                            <div id="rulesEdit">
                                <div v-for="(rule, name) in rules">
                                    <div class="input-group mb-3 no-gutters">
                                        <label class="sr-only" for="rule">{{__('messages.name')}}</label>
                                        <div class="input-group-prepend col-2">
                                            <span class="input-group-text w-100">{% name %}</span>
                                        </div>
                                        <input type="text" :value="rule" class="form-control col-10 px-2" id="rule"
                                               name="rule">
                                    </div>
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


@section('scripts')

    <script>

        new Vue({
            el: '#rulesEdit',
            delimiters: ['{%', '%}'],
            data: {
                rules: {
                    'winnerPoints': 3,
                    'loserPoints': 0,
                    'drawPoints': 1
                }
            }
        });

    </script>

@endsection