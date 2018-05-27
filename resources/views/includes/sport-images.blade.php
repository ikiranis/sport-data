@foreach($sports as $sport)
    <div class="col-lg col-12 my-1">
        <a href="{{route('sport', $sport->slug)}}">
            <div class="card">
                <div class="card-header">{{$sport->name}}</div>

                <img src="{{$sport->photo ? $sport->photo->fullPathName : 'http://via.placeholder.com/350x150'}}"
                     class="card-img-bottom">
            </div>
        </a>
    </div>
@endforeach