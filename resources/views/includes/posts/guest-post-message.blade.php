@if(session('postSaved'))
    <div class="alert-success p-3">
        {{session('postSaved')}}
    </div>
@endif

@if(session('postNotSaved'))
    <div class="alert-danger p-3">
        {{session('postNotSaved')}}
    </div>
@endif