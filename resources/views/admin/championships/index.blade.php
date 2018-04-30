@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.championships')}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('championships.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert championship')}}</button>
        </a>
    </div>

    @if(count($championships)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col">{{__('messages.sport')}}</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($championships as $championship)
                <tr>
                    <th scope="row">{{$championship->id}}</th>
                    <td><a href="{{route('championships.edit', $championship->id)}}">{{$championship->name}}</a></td>
                    <td>{{$championship->sport->name}}</td>
                    <td>
                        <form method="POST" action="{{route('championships.destroy', $championship->id)}}">
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
                {{ $championships->links() }}
            </div>
        </div>


    @else
        <h1>{{__('messages.championships not exist')}}</h1>
    @endif
@endsection
