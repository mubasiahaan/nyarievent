
<!DOCTYPE html>
<html>
    <head>
        <title><?= $html_title?></title>
        <?php $this->load->view('layout/lib'); ?>
    </head>
    <body>
        <?php $this->load->view('layout/header'); ?>
        <?php $this->load->view('layout/content'); ?>
        <?php $this->load->view('layout/footer'); ?>
    </body>
</html>
