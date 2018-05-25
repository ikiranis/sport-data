@extends('layouts.admin')

@section('content')
    <h1>{{trans_choice('messages.comments', 2)}}</h1>

    @if(count($comments)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{__('messages.name')}}</th>
                <th scope="col">{{__('messages.approve')}}</th>
                <th scope="col">{{__('messages.date')}}</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($comments as $comment)
                <tr>
                    <td><a href="{{route('comments.edit', $comment->id)}}">{{$comment->author}}</a></td>
                    <td>{{$comment->approved==1 ? __('messages.active') : __('messages.inactive')}}</td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>

                    <td class="row my-auto">
                        <form method="POST" action="{{route('comments.approvedOrNot', $comment->id)}}" class="col-6">
                            <input name="_method" type="hidden" value="PATCH">
                            <input type="hidden" name="approved" value="{{$comment->approved == 0 ? 1 : 0}}">
                            @csrf

                            {{-- TODO make it with javascript --}}
                            <button type="submit" class="btn-sm btn-outline-success w-100">
                                {{$comment->approved == 0 ? __('messages.active') : __('messages.inactive')}}
                            </button>
                        </form>

                        <form method="POST" action="{{route('comments.destroy', $comment->id)}}" class="col-6">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf

                            <button type="submit" class="btn-sm btn-danger w-100">
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
