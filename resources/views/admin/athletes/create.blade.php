@extends('layouts.admin')

@section('content')

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
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" class="form-control col-10 px-2" id="fname" name="fname">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="lname">{{__('messages.lname')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.lname')}}</span>
                                </div>
                                <input type="text" class="form-control col-10 px-2" id="lname" name="lname">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="birthday">{{__('messages.birthday')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.birthday')}}</span>
                                </div>
                                <input type="text" class="form-control col-10 px-2" id="birthday" name="birthday">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="city">{{__('messages.city')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.city')}}</span>
                                </div>
                                <input type="text" class="form-control col-10 px-2" id="city" name="city">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="country">{{__('messages.country')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.country')}}</span>
                                </div>
                                <input type="text" class="form-control col-10 px-2" id="country" name="country">
                            </div>

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="height">{{__('messages.height')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.height')}}</span>
                                </div>
                                <input type="text" class="form-control col-10 px-2" id="height" name="height">
                            </div>

                            <div class="row my-3">

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
                                    <input type="text" class="form-control" id="reference" name="reference">
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
