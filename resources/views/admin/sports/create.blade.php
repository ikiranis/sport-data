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

                            <div class="form-group my-3">
                                <label class="form-check-label" for="name">{{__('messages.name')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="{{__('messages.name')}}">
                            </div>

                            <div class="form-group my-3 row px-3">
                                <div class="custom-file col-md-8 col-12 ml-auto">
                                    <input type="file" class="custom-file-input" name="uploadFile" id="uploadFile"
                                           accept='image/*'>
                                    <label class="custom-file-label" for="customFile">Εικόνα</label>
                                </div>
                            </div>

                            <div class="form-group my-3 col-md-8 col-12 ml-auto">
                                <label class="form-check-label" for="reference">{{__('messages.reference')}}</label>
                                <input type="text" class="form-control" id="reference" name="reference"
                                       placeholder="{{__('messages.reference')}}">
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
                                    Προσθήκη
                                </button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
