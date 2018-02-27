@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.athletes')}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('athletes.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert athlete')}}</button>
        </a>
    </div>

    @if($athletes)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col">{{__('messages.birthday')}}</th>
                <th scope="col">{{__('messages.city')}}</th>
                <th scope="col">{{__('messages.country')}}</th>
                <th scope="col">{{__('messages.height')}}</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($athletes as $athlete)
                <tr>
                    <th scope="row">{{$athlete->id}}</th>
                    <td><a href="{{route('athletes.edit', $athlete->id)}}">{{$athlete->fname}} {{$athlete->lname}}</a></td>
                    <td>{{$athlete->birthyear}}</td>
                    <td>{{$athlete->city}}</td>
                    <td>{{$athlete->country}}</td>
                    <td>{{$athlete->height}}</td>
                    <td>
                        <form method="POST" action="{{route('athletes.destroy', $athlete->id)}}">
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
                {{ $athletes->links() }}
            </div>
        </div>


    @else
        <h1>{{__('messages.athletes not exist')}}</h1>
    @endif
@endsection
