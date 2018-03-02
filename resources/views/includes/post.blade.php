<div class="col-12 my-3">
    <div class="card">
        <div class="card-header">{{$post->title}}</div>

        <div class="card-body">
            <h3>{{$post->description}}</h3>
            <div class="row">
                <div class="col-md-3 col-12">
                    <img src="{{$post->photo ? $post->photo->fullPathName : 'http://via.placeholder.com/350x150'}}"
                         class="card-img">
                </div>
                <div class="col-md-9 col-12">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
    </div>
</div>