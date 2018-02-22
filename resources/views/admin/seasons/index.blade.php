@extends('layouts.admin')

@section('content')
    <h1>Seasons</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('seasons.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert season')}}</button>
        </a>
    </div>

    @if($seasons)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.name')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($seasons as $season)
                <tr>
                    <th scope="row">{{$season->id}}</th>
                    <td>{{$season->name}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $seasons->links() }}
            </div>
        </div>


    @else
        <h1>{{__('messages.seasons not exist')}}</h1>
    @endif
@endsection
