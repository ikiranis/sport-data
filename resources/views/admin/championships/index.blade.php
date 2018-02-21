@extends('layouts.admin')

@section('content')
    <h1>Πρωταθλήματα</h1>

    @if($championships)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Όνομα</th>
            </tr>
            </thead>
            <tbody>

            @foreach($championships as $championship)
                <tr>
                    <th scope="row">{{$championship->id}}</th>
                    <td>{{$championship->name}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $championships->links() }}
            </div>
        </div>


    @else
        <h1>Δεν υπάρχουν πρωταθλήματα</h1>
    @endif
@endsection
