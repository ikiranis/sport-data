@extends('layouts.admin')

@section('content')
    <h1>Αθλητές</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('athletes.create')}}">
            <button class="btn btn-info w-100">Προσθήκη Αθλητή</button>
        </a>
    </div>

    @if($athletes)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Όνομα</th>
                <th scope="col">Ημ. Γέννησης</th>
                <th scope="col">Πόλη</th>
                <th scope="col">Χώρα</th>
                <th scope="col">Ύψος</th>
            </tr>
            </thead>
            <tbody>

            @foreach($athletes as $athlete)
                <tr>
                    <th scope="row">{{$athlete->id}}</th>
                    <td>{{$athlete->fname}} {{$athlete->lname}}</td>
                    <td>{{$athlete->birthday}}</td>
                    <td>{{$athlete->city}}</td>
                    <td>{{$athlete->country}}</td>
                    <td>{{$athlete->height}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $athletes->links() }}
            </div>
        </div>


    @else
        <h1>Δεν υπάρχουν αθλητές</h1>
    @endif
@endsection
