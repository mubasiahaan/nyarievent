<div class="connect ins"></div>
<div class="hdr ins"><img src="<?= ASSETS_PATH; ?>img/h-daft.png" alt="" /></div>
<div class="body ins">
    <div class="container" style="min-height:600px;">
        <section class="journal read">
            <div class="col-md-12">
                <div class="ket">
                    Sudah punya akun NYARIEVENT? Masuk <a href="<?= site_url('login') ?>">di sini.</a>
                </div>
            </div>
        </section>
        <section class="journal read">
            <div class="col-md-4">
                DAFTAR DENGAN FB
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
                            DAFTAR
                        </h4>
                    </div>
                    <div class="panel-body dafter">
                        <?php
                        if (!empty($error_messages)) {
                            echo $error_messages;
                        }
                        if (!empty($success_messages)) {
                            echo $success_messages;
                        }
                        ?>
                        <form class="form-horizontal" action="<?php echo site_url('register'); ?>" method="post" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                        <?php echo form_input(array('name' => 'txt_name', 'id' => 'name', 'class' => 'form-control', 'value' => set_value('txt_name'))); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nomor Telp</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone" aria-hidden="true"></i></span>
                                        <?php echo form_input(array('name' => 'txt_phone', 'id' => 'phone', 'class' => 'form-control', 'value' => set_value('txt_phone'))); ?>
                                    </div>
                                    <u>Pastikan nomor ponsel Anda aktif untuk keamanan dan kemudahan transaksi.</u>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-send" aria-hidden="true"></i></span>
                                        <?php echo form_input(array('name' => 'txt_email', 'id' => 'email', 'class' => 'form-control', 'value' => set_value('txt_email'))); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">User Name</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                                        <?php echo form_input(array('name' => 'txt_username', 'id' => 'username', 'class' => 'form-control', 'value' => set_value('txt_username'))); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kata Sandi</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock" aria-hidden="true"></i></span>
                                        <?php echo form_password(array('name' => 'txt_password', 'id' => 'password', 'class' => 'form-control', 'value' => set_value('txt_password'))); ?>
                                    </div>
                                    <u>Minimal 6 karakter</u>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <button type="submit" name="submit" value="Register" class="btn btn-primary mar0">Daftar Akun</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>                        
            </div>
        </section>
    </div>
</div>