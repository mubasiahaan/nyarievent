<section>
    <div class="col-lg-12">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span>Form Add User</span>
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
                <form class="form-horizontal" action="<?php echo site_url('admin/users/add'); ?>" method="post" role="form">
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Username</label>
                        <div class="col-lg-11">
                            <?php echo form_input(array('name' => 'txt_username', 'id' => 'username', 'class' => 'form-control', 'value' => set_value('txt_username'))); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Full Name</label>
                        <div class="col-lg-11">
                            <?php echo form_input(array('name' => 'txt_name', 'id' => 'name', 'class' => 'form-control', 'value' => set_value('txt_name'))); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Password</label>
                        <div class="col-lg-11">
                            <?php echo form_password(array('name' => 'txt_password', 'id' => 'password', 'class' => 'form-control', 'value' => set_value('txt_password'))); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Email Address</label>
                        <div class="col-lg-11">
                            <?php echo form_input(array('name' => 'txt_email', 'id' => 'email', 'class' => 'form-control', 'value' => set_value('txt_email'))); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Phone Number</label>
                        <div class="col-lg-11">
                            <?php echo form_input(array('name' => 'txt_phone', 'id' => 'phone', 'class' => 'form-control', 'value' => set_value('txt_phone'))); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Role</label>
                        <div class="col-lg-11">
                            <?php echo form_dropdown("cbo_role", $list_role, set_value('cbo_role', '2'), "class='form-control' id='kategory'"); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Status</label>
                        <div class="col-lg-11">
                            <?php echo form_dropdown("cbo_status", $list_status, set_value('cbo_status'), "class='form-control' id='status'"); ?>
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
</section>


<script>
    // Tiny MCE
    tinymce.init({
        selector: "#txt_description",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });

</script>