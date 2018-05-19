{{--<script src="{{asset('js/ckeditor.js')}}"></script>--}}

{{--<script>--}}

    {{--ClassicEditor--}}
        {{--.create(document.querySelector('#body'))--}}
        {{--.catch(error => {--}}
            {{--console.error(error);--}}
        {{--});--}}

{{--</script>--}}


<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=1azfr0zhlf5i17ungsfoyb11cc6cu4abmnizwww1wtamncu8"></script>
<script>
    tinymce.init({
        selector:'#body',
        height: 500,
        theme: 'modern',
        plugins: "media mediaembed",
    });
</script>


{{--<script src="https://cdn.ckeditor.com/ckeditor5/10.0.0/decoupled-document/ckeditor.js"></script>--}}

{{--<script>--}}
{{--DecoupledEditor--}}
{{--.create( document.querySelector( '#myEditor' ) )--}}
{{--.then( editor => {--}}
{{--const toolbarContainer = document.querySelector( '#toolbar-container' );--}}

{{--toolbarContainer.appendChild( editor.ui.view.toolbar.element );--}}
{{--} )--}}
{{--.catch( error => {--}}
{{--console.error( error );--}}
{{--} );--}}

{{--let editor = document.querySelector('.ck-content');--}}

{{--console.log(editor);--}}

{{--editor.on('key', function(){--}}

{{--console.log('typing');--}}

{{--let bodyInput = document.querySelector( '#body' );--}}
{{--let data = editor.getData(); //reference to ckeditor data--}}
{{--bodyInput.value(data); //update `div` html--}}

{{--});--}}
{{--</script>--}}