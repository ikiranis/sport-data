@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.insert sport')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('sports.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="input-group mb-3">
                                <label class="sr-only" for="name">{{__('messages.name')}}</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" class="form-control" id="name" name="name">
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
