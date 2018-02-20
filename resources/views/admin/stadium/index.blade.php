@extends('layouts.admin')

@section('content')
    <h1>Γήπεδα</h1>

    @if($stadia)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Όνομα</th>
                <th scope="col">Πόλη</th>
            </tr>
            </thead>
            <tbody>

            @foreach($stadia as $stadium)
                <tr>
                    <th scope="row">{{$stadium->id}}</th>
                    <td>{{$stadium->name}}</td>
                    <td>{{$stadium->city}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row text-center">
            <div class="col-6 offset-5">
                {{ $stadia->links() }}
            </div>
        </div>

    @else
        <h1>Δεν υπάρχουν γήπεδα</h1>
    @endif
@endsection
