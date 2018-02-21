@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @php $counter=5; @endphp
            @foreach($sports as $sport)

                <div class="col-md-3">
                    <div class="card card-default">
                        <div class="card-header">{{$sport->name}}</div>

                        <div class="card-body">
                            <img src="http://lorempixel.com/400/200/sports/{{$counter}}"
                                 class="img-fluid">
                        </div>
                    </div>
                </div>
                @php $counter++; @endphp
            @endforeach

        </div>
    </div>
@endsection
