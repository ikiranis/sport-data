@extends('layouts.admin')

@section('content')
    <h1>Seasons</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('seasons.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert season')}}</button>
        </a>
    </div>

    @if(count($seasons)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col" class="text-center">Πρωτάθλημα</th>
                <th scope="col">Άθλημα</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($seasons as $season)
                <tr>
                    <td><a href="{{route('seasons.edit', $season->id)}}">{{$season->name}}</a></td>
                    <td>{{ $season->championship->name }}</td>
                    <td>{{ $season->championship->sport->name }}</td>
                    <td>
                        <form method="POST" action="{{route('seasons.destroy', $season->id)}}">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf

                            <button type="submit" class="btn btn-danger">
                                {{__('messages.delete')}}
                            </button>
                        </form>
                    </td>
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
