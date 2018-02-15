<div class="page-header text-center">
    <h3 class="center">Dashboard - Login</h3>
</div>
<?php if (!empty($form_validation_errors)) { ?>
    <div class="text-center text-danger"><?php echo $form_validation_errors; ?></div>
<?php } ?>
<form class="form-horizontal" action="<?php echo site_url('admin/login'); ?>" role="form" method="post">
    <div class="form-group">
        <label class="col-lg-3 control-label">User ID :</label>
        <div class="col-lg-9">
            <div class="input-group">
                <span class="input-group-addon"><span class="icomoon-icon-user-3"></span></span>
                <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo set_value('username'); ?>">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-lg-3 control-label">Password :</label>
        <div class="col-lg-9">
            <div class="input-group">
                <span class="input-group-addon"><span class="icomoon-icon-key-2"></span></span>
                <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-9">
            <button type="submit" class="btn btn-info" name="submit" value="Login">Login</button>
            <button type="button" class="btn btn-default">Can't Access</button>
        </div>
    </div>
</form>