
<section>
    <div class="col-lg-12">

        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span>Add <?php echo $active_menu; ?></span>
                </h4>
            </div>
            <div class="panel-body">
                <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                <form class="form-horizontal" action="<?php echo site_url('admin/gold_confirm/add/'); ?>" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Date Transfer</label>
                        <div class="col-lg-2">
                            <input type="text" id="datepick"  name="txt_transfer_date"  class="datepick form-control" value="<?php echo set_value('txt_transfer_date'); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">User</label>
                        <div class="col-lg-9">
                            <?php echo form_dropdown("cbo_insert_user", $list_users, set_value('cbo_insert_user'), "class='form-control' id='cbo_insert_user'"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Total</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_total" class="form-control" value="<?php echo set_value('txt_total'); ?>" autofocus="autofocus" placeholder="Input total transfer">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Validation</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_validation" class="form-control" value="<?php echo set_value('txt_validation'); ?>" autofocus="autofocus" placeholder="Input 4 kode validasi terakhir jika setor tunai">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Account Name</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_account" class="form-control" value="<?php echo set_value('txt_account'); ?>" autofocus="autofocus" placeholder="Input nama account bank jika transfer atau internet banking">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Message</label>
                        <div class="col-lg-9">
                            <textarea name="txt_message" id="txt_detail" rows="30" class="txt_detail form-control" placeholder="Input pesan khusus untuk admin"><?php echo set_value('txt_detail'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <input type="submit" name="submit" value="Add Data" class="btn btn-info" />
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
            {title: 'Test template 1', gold_confirm: 'Test 1'},
            {title: 'Test template 2', gold_confirm: 'Test 2'}
        ]
    });

</script>