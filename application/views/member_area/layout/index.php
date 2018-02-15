
<!doctype html>
<html>
    <head>
        <title>Member Area</title>

        <link rel ="shortcut icon" href ="<?= ASSETS_PATH; ?>img/fav.ico"/>
        <link rel ="stylesheet" href ="<?= ASSETS_PATH; ?>admin/css/icons.css" type ="text/css"  />
        <link rel ="stylesheet" href ="<?= ASSETS_PATH; ?>admin/css/jquery.Jcrop.css" type ="text/css"  />
        <link rel ="stylesheet" href ="<?= ASSETS_PATH; ?>plugins/bootstrap-datepicker/css/datepicker3.css" type ="text/css"  />
        
        <script src ="<?= ASSETS_PATH; ?>admin/js/jquery.min.js" type ="text/javascript" ></script>
        <script src ="<?= ASSETS_PATH; ?>admin/js/jquery.Jcrop.js" type ="text/javascript" ></script>
        <script src ="<?= ASSETS_PATH; ?>admin/js/cropsetup.js" type ="text/javascript" ></script>
        <script src ="<?= ASSETS_PATH; ?>plugins/tinymce/js/tinymce/tinymce.min.js" type ="text/javascript" ></script>
        <script src ="<?= ASSETS_PATH; ?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type ="text/javascript" ></script>

        <link rel="stylesheet" href="<?= ASSETS_PATH; ?>css/bootstrap.css">
        <link rel="stylesheet" href="<?= ASSETS_PATH; ?>css/style.css">
        <script src="<?= ASSETS_PATH; ?>js/jquery-1.11.0.min.js"></script>
        <script src="<?= ASSETS_PATH; ?>js/bootstrap.js"></script>

    </head>
    <body>

        <?php $this->load->view('layout/inside/header'); ?>
        <div class="connect ins profil"></div>
        <div class="body ins profil">
            <div class="container">
                <section class="journal read">
                    <?php $this->load->view('member_area/layout/menu'); ?>

                    <?php $this->load->view('layout/content'); ?>
                </section>
            </div>
        </div>
        <?php $this->load->view('layout/footer'); ?>

    </body>
</html>
