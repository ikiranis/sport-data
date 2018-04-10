<div class="col-12 my-3">

    <div class="row">
        <div class="col-12">
            <h2><a href="{{route('post', $post->slug)}}">{{$post->title}}</a></h2>
            <span title="{{$post->created_at}}">{{$post->created_at->diffForHumans()}}</span>
        </div>
    </div>

    <div>
        <div class="col-12 font-weight-bold my-3 text-justify">
            <h4>{{$post->description}}</h4>
        </div>

        <div class="row my-3">
            <div class="col-md-4 col-12">
                <img src="{{$post->photo ? $post->photo->fullPathName : 'http://via.placeholder.com/350x150'}}"
                     class="card-img">

                <ul class="list-group my-2">
                    @if(count($post->teams()->get())>0)
                        <div id="teamsContainer{{$post->id}}">
                            <li class="list-group-item list-group-item-action">
                                @include('includes.teams-list')
                            </li>
                        </div>
                    @endif
                    @if($post->athlete!==null)
                        <li class="list-group-item list-group-item-action"><a
                                    href="">{{$post->athlete->fullName}}</a>
                        </li>
                    @endif
                    @if($post->sport!==null)
                        <li class="list-group-item list-group-item-action"><a
                                    href="{{route('sport', $post->sport->slug)}}">{{$post->sport->name}}</a></li>
                    @endif
                    @if($post->reference!==null)
                        <li class="list-group-item list-group-item-action"><a
                                    href="{{$post->reference}}">{{$post->reference}}</a></li>
                    @endif
                </ul>

            </div>
            <div class="col-md-8 col-12 text-justify">
                {!! $post->body !!}
            </div>
        </div>
    </div>

    @if(session('commentSaved'))
        <div class="alert-success p-3">
            {{session('commentSaved')}}
        </div>
    @endif

    @php ( $countComments = count($post->comments->where('approved', 1)) )

    @if($countComments>0)
        <div>

            <h3>{{$countComments}} {{trans_choice('messages.comments', $countComments)}}</h3>

            @foreach($post->comments->where('approved', 1)->sortBy('created_at')->reverse() as $comment)
                <div class="col-12 my-3">
                    <div class="card">
                        <div class="card-header">
                            {{$comment->created_at->diffForHumans()}} {{__('messages.by')}} <span
                                    class="font-weight-bold">{{$comment->author}}</span>
                        </div>
                        <div class="card-body">
                            {{$comment->body}}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endif

    <div>
        <h3>{{__('messages.write comment')}}</h3>

        <form method="POST" action="{{ route('post.comment.store') }}">
            @csrf

            <input type="hidden" id="post_id" name="post_id" value="{{$post->id}}">
            <input type="hidden" id="post_slug" name="post_slug" value="{{$post->slug}}">
            <input type="hidden" id="approved" name="approved" value="0">

            <div class="input-group mb-3 no-gutters">
                <label class="sr-only" for="author">{{__('messages.name')}}</label>
                <div class="input-group-prepend col-2">
                    <span class="input-group-text w-100">{{__('messages.name')}}</span>
                </div>
                <input type="text" class="form-control col-10 px-2" id="author" name="author">
            </div>

            <div class="input-group mb-3 no-gutters">
                <label class="sr-only" for="email">email</label>
                <div class="input-group-prepend col-2">
                    <span class="input-group-text w-100">email</span>
                </div>
                <input type="text" class="form-control col-10 px-2" id="email" name="email">
            </div>

            <div class="form-group">
                <label class="form-check-label" for="body">{{__('messages.text')}}</label>
                <textarea class="form-control" id="body" name="body" rows="5"></textarea>
            </div>

            <div class="form-group row">
                <button type="submit" class="btn btn-primary col-md-6 col-12 ml-auto mr-auto">
                    {{__('messages.send')}}
                </button>
            </div>


        </form>
    </div>

</div>