{{-- @source https://developers.facebook.com/docs/plugins/like-button# --}}
{{-- @source https://dev.twitter.com/web/tweet-button --}}

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<script>window.twttr = (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
            t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function (f) {
            t._e.push(f);
        };

        return t;
    }(document, "script", "twitter-wjs"));</script>


<!-- Your like button code -->
<div class="row ml-auto mr-auto no-gutters">

    <div class="fb-like col mx-1"
         data-href="{{ secure_url('post/' . $post->slug) }}"
         data-layout="button_count"
         data-action="like"
         data-size="large"
         data-show-faces="true"
         data-share="true">
    </div>

    <a class="twitter-share-button col"
       href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}"
       data-size="large">
        Tweet</a>

</div>