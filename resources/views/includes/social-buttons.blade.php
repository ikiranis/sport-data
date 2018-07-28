<!-- Your like button code -->
<div class="row ml-auto mr-auto no-gutters">

    <div class="fb-like col mx-1"
         data-href="{{ secure_url('/' . $post->slug) }}"
         data-layout="button_count"
         data-action="like"
         data-size="large"
         data-show-faces="false"
         data-share="true">
    </div>

    <a class="twitter-share-button col"
       href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&hashtags=wmsports"
       data-size="large">Tweet</a>

    <link rel="canonical"
          href="{{ secure_url('/' . $post->slug) }}">

</div>