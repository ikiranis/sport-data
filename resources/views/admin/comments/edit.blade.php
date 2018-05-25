@extends('layouts.admin')

@section('content')

    @include('includes.error')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">{{__('messages.update comment')}}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                            <input name="_method" type="hidden" value="PUT">
                            @csrf

                            <input type="hidden" id="post_id" name="post_id" value="{{$comment->post->id}}">

                            <div class="input-group mb-3 no-gutters">
                                <label class="sr-only" for="author">{{__('messages.name')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                                </div>
                                <input type="text" max="255" class="form-control col-10 px-2" id="author" name="author" value="{{$comment->author}}">
                            </div>

                            <div class="form-group">
                                <label class="form-check-label" for="body">{{__('messages.text')}}</label>
                                <textarea class="form-control" id="body" name="body" rows="5">{{$comment->body}}</textarea>
                            </div>

                            <div class="input-group mb-3 no-gutters my-2">
                                <label for="approved" class="sr-only">{{__('messages.approve')}}</label>
                                <div class="input-group-prepend col-2">
                                    <span class="input-group-text w-100 bg-warning">{{__('messages.approve')}}</span>
                                </div>
                                <select class="form-control col-10 px-2" id="approved" name="approved">
                                    <option value="0" {{$comment->approved==0 ? 'selected' : ''}}>{{__('messages.inactive')}}</option>
                                    <option value="1" {{$comment->approved==1 ? 'selected' : ''}}>{{__('messages.active')}}</option>
                                </select>
                            </div>

                            <div class="form-group row">
                                <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
                                    {{__('messages.update')}}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection






