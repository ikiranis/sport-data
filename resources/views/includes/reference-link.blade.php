@if($post->reference!==null)
    <div class="row my-3">
        <a href="{{ $post->reference }}" class="ml-auto mr-auto" title="{{$post->reference}}">
            <span class="btn btn-outline-info">Περισσότερα στο <strong>{{ parse_url($post->reference)['host'] }}</strong></span>
        </a>
    </div>
@endif