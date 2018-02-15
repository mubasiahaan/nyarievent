
<!doctype html>
<html>
    <head>
        <title>admin</title>
        <?php
        render_html_title($html_title);
        render_html_metalink($html_meta);
        render_html_metalink($seo);
        render_html_metalink($html_admin_link, 'link');
        render_html_metalink($html_admin_script, 'script');
        
        
        /*
         [{"src":"{app_assets_path}\/admin\/js\/jquery-1.11.0.min.js","type":"text\/javascript"},{"src":"{app_assets_path}\/admin\/js\/bootstrap.js","type":"text\/javascript"},{"src":"{app_assets_path}\/admin\/js\/jquery.min.js","type":"text\/javascript"},{"src":"{app_assets_path}\/admin\/js\/jquery.Jcrop.js","type":"text\/javascript"},{"src":"{app_assets_path}\/admin\/js\/cropsetup.js","type":"text\/javascript"},{"src":"{app_assets_path}\/plugins\/tinymce\/js\/tinymce\/tinymce.min.js","type":"text\/javascript"},{"src":"{app_assets_path}\/plugins\/bootstrap-datepicker\/js\/bootstrap-datepicker.js","type":"text\/javascript"},{"src":"{app_assets_path}\/admin\/js\/jquery.dataTables.min.js","type":"text\/javascript"},{"src":"{app_assets_path}\/admin\/js\/dataTables.bootstrap.min.js","type":"text\/javascript"}]
         */
        ?>
        
        <link rel="stylesheet" href="http://mrmsys.com/assets/css/admin-style.css" type="text/css">
        
        
    </head>
    <body>
        <?php $this->load->view('admin/layout/header'); ?>

        <section id="body" class="clearfix">
            <div id="main" class="col-lg-12">

                <?php $this->load->view('admin/layout/navigation'); ?>
                <?php $this->load->view('admin/layout/content'); ?>

                <footer>Copyright &COPY; <a href="leveloco.com">Leveloco</a></footer>
            </div>
        </section>
    </body>
</html>
