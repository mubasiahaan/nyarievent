<div class="container">
    <section class="clearfix">
        <div class="col-md-12 pad0">
            <a href="#">
                <h2 class="panel-header-text"><span>Profile </span> User</h2>
            </a>
            <div class="dvd"></div>
        </div>
    </section>
</div>
<div class="main">
    <div class="container">
        <section class="clearfix">
            <div class="col-md-10 col-md-offset-1 pad0">
				<div class="contact mar-top30 mar-btm30">
					<h3>Edit User</h3>
					<?php
					if (!empty($error_messages)) {
						echo $error_messages;
					}
					if (!empty($success_messages)) {
						echo $success_messages;
					}
					?>
					<form class="form-horizontal" action="<?php echo site_url('member_area/index'); ?>" method="post" role="form">
						<div class="form-group">
							<label class="col-md-2 control-label" for="focus">Username</label>
							<div class="col-md-10">
								<?php echo $user_update->username ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="focus">Full Name</label>
							<div class="col-md-10">
								<?php echo form_input(array('name' => 'txt_name', 'id' => 'name', 'class' => 'form-control', 'value' => !empty($user_update->name) ? $user_update->name : set_value('txt_name'))); ?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label" for="focus">Email Address</label>
							<div class="col-md-10">
								<?php echo form_input(array('name' => 'txt_email', 'id' => 'email', 'class' => 'form-control', 'value' => !empty($user_update->email) ? $user_update->email : set_value('txt_email'))); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="focus">Phone Number</label>
							<div class="col-md-10">
								<?php echo form_input(array('name' => 'txt_phone', 'id' => 'phone', 'class' => 'form-control', 'value' => !empty($user_update->phone) ? $user_update->phone : set_value('txt_phone'))); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="focus">Qoutes</label>
							<div class="col-md-10">
								<textarea name="txt_qoutes" id="txt_qoutes" class="txt_qoutes form-control" placeholder="Input qoutes"><?php echo!empty($user_update->qoutes) ? $user_update->qoutes : set_value('txt_qoutes'); ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-10">
								<input type="submit" name="submit" value="Save" class="btn btn-info" />
								<?php if ($user_update->name == "#"){?>
								<a href="<?php echo site_url('member_area/reset_pass/'); ?>"
								   class="btn btn-warning"><span class="glyphicon icomoon-icon-key-2"></span>Reset Password </a>
								<?php }?>

							</div>

						</div>
					</form>
					<hr/>
                <?php
                if (!empty($error_messages)) {
                    echo $error_messages;
                }
                if (!empty($success_messages)) {
                    echo $success_messages;
                }
                ?>
                <form class="form-horizontal" action="<?php echo site_url('member_area/index'); ?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="focus">Avatar</label>
                        <div class="col-md-10">
                            <img src="<?= print_avatar($user_update->id) ?>" alt="" class="img-responsive" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="focus">Image (Resolusi 200*100)</label>
                        <div class="col-md-10">
                            <input type="file" name="file_image" id="image" class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <input type="submit" name="avatar" value="Update Avatar" class="btn btn-info" />
                        </div>
                    </div>
                </form>
            </div>

    </div>
</section>
        </div>
    </div>


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