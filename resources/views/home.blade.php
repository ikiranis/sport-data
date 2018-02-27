@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

                @foreach($sports as $sport)

                    <div class="col-lg-3 col-12 my-1">
                        <div class="card">
                            <div class="card-header">{{$sport->name}}</div>

                            <img src="{{$sport->photo ? $sport->photo->fullPathName : 'http://via.placeholder.com/350x150'}}" class="card-img-bottom">
                        </div>
                    </div>
                @endforeach

        </div>
    </div>
@endsection
