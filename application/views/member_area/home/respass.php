<div class="col-lg-10">
    <div class="panel panel-blue">
        <div class="panel-heading">
            <h4>
                <span>Form Reset Password User</span>
            </h4>
        </div>
        <div class="panel-body">
            <?php
            if (!empty($error_messages)) {
                echo $error_messages;
            }
            if (!empty($success_messages)) {
                echo $success_messages;
            }
            ?>
            <form class="form-horizontal" action="<?php echo site_url('member_area/home/reset_pass'); ?>" method="post" role="form">
                <div class="form-group">
                    <label class="col-lg-1 control-label" for="focus">New Password :</label>
                    <div class="col-lg-11">
                        <?php echo form_password(array('name' => 'txt_new_pass', 'id' => 'new_pass', 'class' => 'form-control', 'value' => "")); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-1 control-label" for="focus">Retype :</label>
                    <div class="col-lg-11">
                        <?php echo form_password(array('name' => 'txt_retype', 'id' => 'retype', 'class' => 'form-control', 'value' => "")); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        <input type="submit" name="submit" value="Save" class="btn btn-info" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>