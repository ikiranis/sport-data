@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.stadia')}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('stadium.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert stadium')}}</button>
        </a>
    </div>

    @if($stadia)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col">{{__('messages.city')}}</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($stadia as $stadium)
                <tr>
                    <th scope="row">{{$stadium->id}}</th>
                    <td>{{$stadium->name}}</td>
                    <td>{{$stadium->city}}</td>
                    <td>
                        <form method="POST" action="{{route('stadium.destroy', $stadium->id)}}">
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
                {{ $stadia->links() }}
            </div>
        </div>

    @else
        <h1>{{__('messages.stadia not exist')}}</h1>
    @endif
@endsection
