<script>

    new Vue({
        el: '#tagsContainer' + '{!! $post->id !!}',
        delimiters: ['{%', '%}'],
        data: {
            tags: {!! json_encode($post->tags()->get()) !!}
        }
    });

</script>
