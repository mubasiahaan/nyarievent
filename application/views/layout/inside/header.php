
<?php $this->load->view('layout/menu'); ?>

<div class="logos" role="navigation">
    <div class="containerrr">
        <div class="pull-left hidden-xs">
            <p class="call">Call us : <span><?= $web_info['phone'] ?></span></p>
            <?php if ($this->session->userdata('sess-id')) { ?>   
                <p class="msg"><a href="<?= site_url('member_area/home/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> Logout </a></p>
            <?php } else { ?>
                <p class="msg"><a href="<?= site_url('login') ?>"><i class="glyphicon glyphicon-log-in"></i> Login </a></p>
            <?php } ?>
        </div>
    </div>
</div>
<a class="navbar-brand topBar-info" href="<?= site_url() ?>">
    <img src="<?= ASSETS_PATH; ?>img/nyarievent-logo.png" alt="" />
</a>
