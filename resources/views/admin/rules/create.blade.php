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
                                <input type="text" class="form-control col-10 px-2" id="name"
                                       name="name">
                            </div>

                            <div id="rulesEdit">
                                <div v-for="(value, key) in rules">
                                    <div class="input-group mb-3 no-gutters">
                                        <div class="input-group-prepend col-4">
                                            <label class="sr-only" :for="key">{% key %}</label>
                                            <input type="text" :value="key" class="input-group-text w-100" :id="key"
                                                   v-on:change="setKeyValue($event, key)">
                                        </div>
                                        <input type="text" class="form-control col-6 px-2"
                                               v-model="rules[key]">
                                        <input type="button" class="btn btn-danger col-2 px-2"
                                               value="Αφαίρεση" v-on:click="removeField(key)">
                                    </div>

                                </div>

                                <input type="hidden" name="description" :value="JSON.stringify(rules)">

                                <div class="row">
                                    <input type="button" id="insertField" class="btn btn-outline-warning ml-auto mr-auto"
                                           value="Προσθήκη πεδίου" v-on:click="insertField">
                                </div>
                            </div>


                            <div class="form-group row my-2">
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
                },
            },
            methods: {
                insertField() {
                    Vue.set(this.rules, 'void', '');
                },
                removeField(key) {
                    Vue.delete(this.rules, key);
                },
                renameProperty(oldProperty, newProperty) {
                    if(oldProperty !== newProperty) {
                        Vue.set(this.rules, newProperty, this.rules[oldProperty]);
                        Vue.delete(this.rules, oldProperty);
                    }
                },
                setKeyValue(e, key) {
                    this.renameProperty(key, e.target.value);

                }
            }
        });

    </script>

@endsection