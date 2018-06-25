@include('includes.image-modal')

<div class="col-12 my-3">

    <div class="row">
        <div class="col-12 text-right">
            <h2 class="text-center"><a href="{{route('post', $post->slug)}}">{{$post->title}}</a></h2>
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
                     class="card-img btn" data-toggle="modal" data-target="#imageModal{{ $post->id }}">

                <ul class="list-group my-2">
                    @if(count($post->teams()->get())>0)
                        <div id="teamsContainer{{$post->id}}">
                            <li class="list-group-item list-group-item-action">
                                @include('includes.teams-list')
                            </li>
                        </div>
                    @endif
                    @if(count($post->tags()->get())>0)
                        <div id="tagsContainer{{$post->id}}">
                            <li class="list-group-item list-group-item-action">
                                @include('includes.tags-list')
                            </li>
                        </div>
                    @endif
                    @if($post->athlete!==null)
                        <li class="list-group-item list-group-item-action"><a
                                    href="{{route('athlete', $post->athlete->slug)}}">{{$post->athlete->fullName}}</a>
                        </li>
                    @endif
                    @if($post->sport!==null)
                        <li class="list-group-item list-group-item-action"><a
                                    href="{{route('sport', $post->sport->slug)}}">{{$post->sport->name}}</a></li>
                    @endif
                </ul>

                {{--<div class="row my-2">--}}
                    {{--@include('includes.social-buttons')--}}
                {{--</div>--}}

            </div>
            <div class="col-md-8 col-12 text-justify article">
                {!! $post->body !!}

                @include('includes.reference-link')

            </div>


        </div>

        @include('includes.ads.post-google-ad')

    </div>

    @if(session('commentSaved'))
        <div class="alert-success p-3">
            {{session('commentSaved')}}
        </div>
    @endif

    @php ( $countComments = count($post->comments->where('approved', 1)) )

    @include('includes.error')

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
        @include('includes.comment-form')
    </div>

</div>