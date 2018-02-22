@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.sports')}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('sports.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert sport')}}</button>
        </a>
    </div>

    @if($sports)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.name')}}</th>
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
        <h1>{{__('messages.sports not exist')}}</h1>
    @endif
@endsection
