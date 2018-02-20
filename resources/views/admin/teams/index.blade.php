@extends('layouts.admin')

@section('content')
    <h1>Ομάδες</h1>

    @if($teams)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Όνομα</th>
                <th scope="col">Πόλη</th>
            </tr>
            </thead>
            <tbody>

            @foreach($teams as $team)
                <tr>
                    <th scope="row">{{$team->id}}</th>
                    <td>{{$team->name}}</td>
                    <td>{{$team->city}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row text-center">
            <div class="col-6 offset-5">
                {{ $teams->links() }}
            </div>
        </div>


    @else
        <h1>Δεν υπάρχουν αθλητές</h1>
    @endif
@endsection
