@extends('layouts.admin')

@section('content')
    <h1>Χρήστες</h1>

    @if($users)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Όνομα</th>
                <th scope="col">E-mail</th>
                <th scope="col">Ρόλος</th>
                <th scope="col">Ενεργός</th>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active==1 ? 'Ενεργός' : 'Ανενεργός'}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    @else
        <h1>Δεν υπάρχουν χρήστες</h1>
    @endif
@endsection
