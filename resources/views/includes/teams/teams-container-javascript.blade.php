<script>

    new Vue({
        el: '#teamsContainer' + '{!! $post->id !!}',
        delimiters: ['{%', '%}'],
        data: {
            teamsSelected: {!! json_encode($post->teams()->get()) !!}
        }
    });

</script>
