@extends('layouts.admin')

@section('content')
    <h1>Αγωνιστικές</h1>

    @if($matchdays)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Όνομα</th>
            </tr>
            </thead>
            <tbody>

            @foreach($matchdays as $matchday)
                <tr>
                    <th scope="row">{{$matchday->id}}</th>
                    <td>{{$matchday->matchday}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $matchdays->links() }}
            </div>
        </div>


    @else
        <h1>Δεν υπάρχουν αγωνιστικές</h1>
    @endif
@endsection
