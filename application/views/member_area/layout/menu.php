<div class="col-lg-2 col-md-3">
    <div class="profile-sidebar">
        <div class="profile-usertitle">
            <div class="profile-userpic">
                <img src="<?= print_avatar($user_update->id) ?>" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle-name">
                <?php echo $user_update->username ?>
            </div>
            <div class="profile-usertitle-job">
                <?php echo $user_update->name ?>
            </div>
        </div>
        <div class="text-center">
            <a href="<?= site_url('member_area/home/edit_profile') ?>"><button type="button" class="btn btn-success btn-sm">Edit Profile</button></a>
			<?php if ($user_update->name == "#"){?>
            <a href="<?= site_url('member_area/home/reset_pass') ?>"><button type="button" class="btn btn-danger btn-sm">Reset password</button></a>
			<?php }?>
        </div>

        <div class="profile-usermenu">
            <ul class="nav">
                <li <?= ($controler == 'home' ) ? 'class="active"' : '' ?>>
                    <a href="<?= site_url('member_area/home') ?>">
                        <i class="glyphicon glyphicon-home"></i>
                        Home </a>
                </li>
                <li <?= ($controler == 'event' ) ? 'class="active"' : '' ?>>
                    <a href="<?= site_url('member_area/event') ?>">
                        <i class="glyphicon glyphicon-tag"></i>
                        Event </a>
                </li>
                <li <?= ($controler == 'share_moment' ) ? 'class="active"' : '' ?>>
                    <a href="<?= site_url('member_area/share_moment') ?>" >
                        <i class="glyphicon glyphicon-tag"></i>
                        Share Moment </a>
                </li>

                <?php if ($this->session->userdata('sess-gold_expired') < date("Y-m-d")) { ?>
                    <li <?= ($controler == 'upgrade' ) ? 'class="active"' : '' ?>>
                        <a href="<?= site_url('member_area/upgrade') ?>">
                            <i class="glyphicon glyphicon-asterisk"></i>
                            Upgrade To Gold Member </a>
                    </li>
                <?php } ?>


                <li <?= ($controler == 'ticket' ) ? 'class="active"' : '' ?>>
                    <a href="<?= site_url('member_area/ticket') ?>" >
                        <i class="glyphicon glyphicon-inbox"></i>
                        inbox </a>
                </li>
                <li <?= ($controler == 'faq' ) ? 'class="active"' : '' ?>>
                    <a href="<?= site_url('member_area/home/logout'); ?>">
                        <i class="glyphicon glyphicon-log-out"></i>
                        Log Out </a>
                </li>
            </ul>
        </div>
    </div>
</div>