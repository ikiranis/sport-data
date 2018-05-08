@extends('layouts.app')

@section('content')
    <h1>{{$sport->name}}</h1>

    <div class="container">
        @if(count($posts)>0)

            @if(count($championships)>0)

                <form method="GET" action="{{route('championship')}}">

                    @csrf

                    <div class="container w-75">
                        <div class="input-group no-gutters ml-auto mr-auto row">
                            <label for="championship_id" class="sr-only">Πρωτάθλημα</label>
                            <select class="form-control col-8 px-2" id="championship_id" name="championship_id">
                                <option value="0"></option>
                                @foreach($championships as $championship)
                                    <option value="{{$championship->id}}">
                                        {{$championship->name}}
                                    </option>
                                @endforeach
                            </select>

                            <button type="submit" class="btn btn-info col-4 mx-2">
                                Επιλογή πρωταθλήματος
                            </button>
                        </div>
                    </div>

                </form>

            @endif

            @foreach($posts as $post)

                @include('includes.post-list')

            @endforeach

            <div class="row">
                <div class="ml-auto mr-auto">
                    {{ $posts->links() }}
                </div>
            </div>

        @endif
    </div>

@endsection

@section('scripts')

    @if(count($posts)>0)
        @foreach($posts as $post)
            @if(count($post->teams()->get())>0)
                @include('includes.teams-container-javascript')
            @endif
        @endforeach
    @endif

@endsection