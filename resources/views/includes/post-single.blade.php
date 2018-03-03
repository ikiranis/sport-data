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
                        <li class="list-group-item list-group-item-action"><a href="">{{$post->team->name}}</a></li>
                        <li class="list-group-item list-group-item-action"><a href="">{{$post->athlete->fullName}}</a>
                        </li>
                        <li class="list-group-item list-group-item-action"><a
                                    href="{{route('sport', $post->sport->slug)}}">{{$post->sport->name}}</a></li>
                        <li class="list-group-item list-group-item-action"><a
                                    href="{{$post->reference}}">{{$post->reference}}</a></li>
                    </ul>
                </div>
                <div class="col-md-8 col-12 text-justify">
                    {!! $post->body !!}
                </div>
            </div>
        </div>

        <div>
            <h1>Σχόλια</h1>

            <form method="POST" action="{{ route('post.comment.store') }}">
                @csrf

                <input type="hidden" id="post_id" name="post_id" value="{{$post->id}}">
                <input type="hidden" id="post_slug" name="post_slug" value="{{$post->slug}}">

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
                        Αποστολή
                    </button>
                </div>


            </form>
        </div>

</div>