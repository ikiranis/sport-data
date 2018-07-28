<h3>{{__('messages.write comment')}}</h3>

<form method="POST" action="{{ route('post.comment.store') }}">
    @csrf

    <input type="hidden" id="post_id" name="post_id" value="{{$post->id}}">
    <input type="hidden" id="post_slug" name="post_slug" value="{{$post->slug}}">
    <input type="hidden" id="approved" name="approved" value="0">

    <div class="input-group mb-3 no-gutters">
        <label class="sr-only" for="author">{{__('messages.name')}}</label>
        <div class="input-group-prepend col-3">
            <span class="input-group-text w-100 px-3">{{__('messages.name')}}</span>
        </div>
        <input type="text" class="form-control col-9 px-2" id="author" name="author"
               value="{{old('author')}}">
    </div>

    <div class="form-group">
        <label class="form-check-label" for="body">{{__('messages.text')}}</label>
        <textarea class="form-control" id="body" name="body" rows="5">{{old('body')}}</textarea>
    </div>

    <div class="form-group row">
        <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
            {{__('messages.send')}}
        </button>
    </div>


</form>