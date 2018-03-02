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
                        <li class="list-group-item"><a href="">{{$post->team->name}}</a></li>
                        <li class="list-group-item"><a href="">{{$post->athlete->fullName}}</a></li>
                        <li class="list-group-item"><a href="{{route('sport', $post->sport->slug)}}">{{$post->sport->name}}</a></li>
                        <li class="list-group-item"><a href="{{$post->reference}}">{{$post->reference}}</a></li>
                    </ul>
                </div>
                <div class="col-md-8 col-12 text-justify">
                    {!! $post->body !!}
                </div>
            </div>
        </div>

</div>