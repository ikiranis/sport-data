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
                </div>
                <div class="col-md-9 col-12">
                    {!! $post->body !!}
                </div>
            </div>
            <div class="row my-1">
                <div class="col-12 text-right">
                    <a href="{{$post->reference}}">{{$post->reference}}</a>
                </div>
            </div>
        </div>

        <div class="card-footer text-center">
            <a href="">{{$post->team->name}}</a> |
            <a href="">{{$post->athlete->fullName}}</a> |
            <a href="{{route('sport', $post->sport->slug)}}">{{$post->sport->name}}</a>
        </div>

    </div>
</div>