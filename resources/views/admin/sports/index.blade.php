@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.sports')}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('sports.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert sport')}}</button>
        </a>
    </div>

    @if(count($sports)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($sports as $sport)
                <tr>
                    <th scope="row">{{$sport->id}}</th>
                    <td><a href="{{route('sports.edit', $sport->id)}}">{{$sport->name}}</a></td>
                    <td>
                        <form method="POST" action="{{route('sports.destroy', $sport->id)}}">
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
                {{ $sports->links() }}
            </div>
        </div>


    @else
        <h1>{{__('messages.sports not exist')}}</h1>
    @endif
@endsection
