<div class="modal fade" id="imageModal{{ $post->id }}" tabindex="-1" role="dialog"
     aria-labelledby="imageModal{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="elementModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <img src="{{$post->photo ? $post->photo->fullPathName : 'http://via.placeholder.com/350x150'}}"
                     width="100%">

            </div>

            @if(isset($post->photo->reference))
                <div class="modal-footer row w-100 no-gutters">
                    <span>Πηγή:
                        <a href="{{ $post->photo->reference }}" class="font-weight-bold">
                            {{ parse_url($post->photo->reference)['host'] }}
                        </a>
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>