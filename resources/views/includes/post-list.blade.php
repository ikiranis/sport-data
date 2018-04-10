<div class="col-12 my-3">
    <div class="card">
        <div class="card-header row no-gutters">
            <div class="col-6 my-auto">
                <h3><a href="{{route('post', $post->slug)}}">{{$post->title}}</a></h3>
            </div>
            <div class="col-6 ml-auto text-right my-auto">
                <span title="{{$post->created_at}}">{{$post->created_at->diffForHumans()}}</span>
            </div>
        </div>

        <div class="card-body">
            <div class="col-12 text-center font-weight-bold my-3">
                <h4>{{$post->description}}</h4>
            </div>

            <div class="row my-3">
                <div class="col-md-3 col-12">
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
                        @if(count($post->comments)>0)
                            <li class="list-group-item list-group-item-action"><a
                                        href="{{route('post', $post->slug)}}">{{count($post->comments)}} {{trans_choice('messages.comments', count($post->comments))}}</a>
                            </li>
                        @endif
                    </ul>

                </div>
                <div class="col-md-9 col-12">
                    @php ($moreButton = ' [...] <p><a href="'. route('post', $post->slug). '"><span class="btn btn-secondary">more</span></a></p>')

                    {!! Str::words($post->body, 200, $moreButton) !!}
                </div>
            </div>
            <div class="row my-1">
                <div class="col-12 text-right">
                    <a href="{{$post->reference}}">{{$post->reference}}</a>
                </div>
            </div>
        </div>

    </div>
</div>
