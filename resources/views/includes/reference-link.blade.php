@if($post->reference!==null)

    @php
        $reference = parse_url($post->reference);
    @endphp

    <div class="row my-3">
        <a href="{{ $post->reference }}" class="ml-auto mr-auto" title="{{$post->reference}}">
            <span class="btn btn-outline-info">Περισσότερα στο <strong>{{ $reference['host']  }}</strong></span>
        </a>
    </div>
@endif