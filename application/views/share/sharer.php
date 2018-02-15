<script>
    window.twttr = (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0], t = window.twttr || {};
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);
        t._e = [];
        t.ready = function (f) {
            t._e.push(f);
        };
        return t;
    }(document, "script", "twitter-wjs"));
</script>

<div id="fb-root"></div>
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.12&appId=1780441912251056&autoLogAppEvents=1';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<div style="display: inline;">
    
    <div class="fb-share-button" data-href="<?php echo!empty($link) ? $link : site_url(); ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Bagikan</a></div>
    
    <a class="twitter-share-button"
       href="<?php echo!empty($link) ? $link : site_url(); ?>"
       data-url="<?php echo!empty($link) ? $link : site_url(); ?>"
       data-via="nyarievent.com"
       data-text="<?php echo $rec_detail->title; ?>"
       data-related="Nyari event"
       data-count="vertical">
        Tweet
    </a>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script>
        window.___gcfg = {
            lang: 'en-US',
            parsetags: 'onload'
        };
    </script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!-- Place this tag where you want the share button to render. -->
    <div class="g-plus" data-action="share" data-href="<?php echo!empty($link) ? $link : site_url(); ?>"></div>
   
    <style>
        .fb-share-button > span{margin: 4px 0!important;}
    </style>	
</div>
