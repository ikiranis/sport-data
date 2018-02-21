@extends('layouts.admin')

@section('content')
    <h1>Αθλήματα</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('sports.create')}}">
            <button class="btn btn-info w-100">Προσθήκη αθλήματος</button>
        </a>
    </div>

    @if($sports)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Όνομα</th>
            </tr>
            </thead>
            <tbody>

            @foreach($sports as $sport)
                <tr>
                    <th scope="row">{{$sport->id}}</th>
                    <td>{{$sport->name}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $sports->links() }}
            </div>
        </div>


    @else
        <h1>Δεν υπάρχουν αθλήματα</h1>
    @endif
@endsection
