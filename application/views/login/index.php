<div class="connect ins"></div>
<div class="hdr ins"><img src="<?= ASSETS_PATH; ?>img/h-daft.png" alt="" /></div>
<div class="body ins">
    <div class="container" style="min-height:600px;">
        <section class="journal read">
            <div class="col-md-12">
                <div class="ket">
                    Belum punya akun NYARIEVENT? Daftar <a href="<?= site_url('register') ?>">di sini.</a>
                </div>
            </div>
        </section>
        <section class="journal read">
            <div class="col-md-4">
                LOGIN DENGAN FB
				<br>
                <br>
                <br>
                <a href="<?= site_url('login_by/facebook_handler')?>"><button type="submit" name="submit" value="Register" class="btn btn-primary mar0">Join with Facebook</button></a>
                <br>
                <br>
                 <a href="<?= site_url('login_by/google_handler')?>"><button type="submit" name="submit" value="Register" class="btn btn-primary mar0">Join with Gmail</button></a>
            </div>
            <div class="col-md-1">
                <div class="atw"></div>
                <p class="atww">atau</p>
            </div>
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>
                            LOGIN
                        </h4>
                    </div>
                    <div class="panel-body dafter">
                        <?php if (!empty($form_validation_errors)) { ?>
                            <div class="text-center text-danger"><?php echo $form_validation_errors; ?></div>
                        <?php } ?>
                        <form class="form-horizontal" action="<?php echo site_url('login'); ?>" role="form" method="post">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">User Name</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo set_value('username'); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kata Sandi</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
                                        <?php echo form_password(array('name' => 'password', 'id' => 'password', 'class' => 'form-control', 'value' => set_value('txt_password'))); ?>
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-default" name="submit" value="Login">Login</button>
                                    &emsp; or <a href="<?php echo site_url('register'); ?>"
                                                 class="btn btn-link"><span class="glyphicon icomoon-icon-key-2"></span>Register</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>                        
            </div>
        </section>
    </div>

</div>