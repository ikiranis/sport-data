@extends('layouts.admin')

@section('content')
    <h1>{{trans_choice('messages.comments', 2)}}</h1>

    @if(count($comments)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">email</th>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col">{{__('messages.approve')}}</th>
                <th scope="col">{{__('messages.date')}}</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($comments as $comment)
                <tr>
                    <th scope="row">{{$comment->id}}</th>
                    <td><a href="{{route('comments.edit', $comment->id)}}">{{$comment->email}}</a></td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->approved==1 ? __('messages.active') : __('messages.inactive')}}</td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>

                    <td>
                        <form method="POST" action="{{route('comments.destroy', $comment->id)}}">
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
                {{ $comments->links() }}
            </div>
        </div>


    @else
        <h1>{{__('messages.comments not exist')}}</h1>
    @endif
@endsection
