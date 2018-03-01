@extends('layouts.admin')

@section('content')
    <h1>{{__('messages.posts')}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('posts.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert post')}}</button>
        </a>
    </div>

    @if(count($posts)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('messages.title')}}</th>
                <th scope="col">{{__('messages.users')}}</th>
                <th scope="col">{{__('messages.athletes')}}</th>
                <th scope="col">{{__('messages.teams')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->athlete->fullName}}</td>
                    <td>{{$post->team->name}}</td>

                    <td>
                        <form method="POST" action="{{route('posts.destroy', $post->id)}}">
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
                {{ $posts->links() }}
            </div>
        </div>


    @else
        <h1>{{__('messages.posts not exist')}}</h1>
    @endif
@endsection
