<div class="row-fluid">
    <div class="navbar">
        <div class="navbar-inner">
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a> <span class="divider">/</span>	
                </li>
                <li class="active">Change Password</li>
            </ul>
        </div>
    </div>
</div>
<?php
echo form_open('dashboard/user/change_pass/id/' . $key_update, array(
    'class' => 'form-horizontal'
));
?>

<div class="row-fluid">
    <div class="block">
        <div class="navbar navbar-inner block-header">
            <div class="muted pull-left">Change Password</div>
        </div>
        <div class="block-content collapse in">
            <?php
            if (!empty($error_messages)) {
                echo $error_messages;
            }
            if (!empty($success_messages)) {
                echo $success_messages;
            }
            ?>
            <table class="table table-striped">
                <tr>
                    <td>Old Password :</td>
                    <td><?php echo form_password(array('name' => 'txt_old_pass', 'id' => 'old_pass', 'class' => 'form-control', 'value' => "")); ?></td>
                </tr>
                <tr>
                    <td>New Password :</td>
                    <td><?php echo form_password(array('name' => 'txt_new_pass', 'id' => 'new_pass', 'class' => 'form-control', 'value' => "")); ?></td>
                </tr>
                <tr>
                    <td>Retype :</td>
                    <td><?php echo form_password(array('name' => 'txt_retype', 'id' => 'retype', 'class' => 'form-control', 'value' => "")); ?></td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" name="submit" class="btn btn-primary"
                                value="insert-record">
                            <span class="glyphicon glyphicon-floppy-save"></span> Save 
                        </button>
                    </td>
                    <td>
                        <a href="<?php echo site_url('dashboard/user'); ?>"
                           class="btn btn-warning"><span class="glyphicon glyphicon-remove"></span>Cancel</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<?php
echo form_close();
?>