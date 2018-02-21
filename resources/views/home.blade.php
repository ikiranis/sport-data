@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @foreach($sports as $sport)
                <div class="col-md-3">
                    <div class="card card-default">
                        <div class="card-header">{{$sport->name}}</div>

                        <div class="card-body">

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
