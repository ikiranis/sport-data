@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card-group">

                @foreach($sports as $sport)

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">{{$sport->name}}</div>

                            <img src="{{$sport->photo->fullPathName}}" class="card-img-bottom">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
