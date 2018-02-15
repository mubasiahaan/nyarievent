
<section>
    <div class="col-lg-12">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span><?= $page_title; ?></span>
                </h4>
            </div>
            <div class="panel-body">
                <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                <form class="form-horizontal" action="<?php echo site_url('admin/ticket/update/' . $rec_data->id); ?>" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Subject</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_subject" class="form-control" value="<?php echo set_value('txt_subject', $rec_data->subject); ?>" autofocus="autofocus" placeholder="Enter Network Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">User</label>
                        <div class="col-lg-9">
                            <?php echo form_dropdown("cbo_insert_user", $list_users, set_value('cbo_insert_user', $rec_data->insert_user), "class='form-control' id='cbo_insert_user'"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Detail</label>
                        <div class="col-lg-9">
                            <textarea name="txt_detail" id="txt_detail" rows="30" class="txt_detail form-control" placeholder="Input your preface"><?php echo set_value('txt_detail', $rec_data->detail); ?></textarea>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <input type="submit" name="submit" value="Save Change" class="btn btn-info" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



<script>
    $('#datepick').datepicker({
        format: 'yyyy-mm-dd',
    });
</script>

<script>
    // Tiny MCE
    tinymce.init({
        selector: ".txt_detail",
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
            {title: 'Test template 1', ticket: 'Test 1'},
            {title: 'Test template 2', ticket: 'Test 2'}
        ]
    });

</script>