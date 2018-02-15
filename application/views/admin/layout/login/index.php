<!DOCTYPE html>
<html lang="en">
    <head>      
        <?php
        render_html_title($html_title);
        render_html_metalink($html_meta);
        render_html_metalink($seo);
        render_html_metalink($html_admin_link, 'link');
        render_html_metalink($html_admin_script, 'script');
        
        
        ?>
    </head>
    <body class="loginPage">
        <div class="login">
            <?php echo $page; ?>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.login').hide();
                $('.login').fadeIn(1000).animate({
                    'top': "50%", 'margin-top': +($('.login').height() / -2 - 30)
                }, {duration: 750, queue: false}, function () {
                });
            });
        </script>
    </body>
</html>