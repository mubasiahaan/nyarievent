<?php $this->load->view('admin/modal'); ?>

<section>
    <div class="col-lg-10">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span>Add <?php echo $active_menu; ?></span>
                </h4>
            </div>
            <div class="panel-body">
                <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                <form class="form-horizontal" action="<?php echo site_url('member_area/share_moment/add/'); ?>" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Title</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_name" class="form-control" value="<?php echo set_value('txt_name'); ?>" autofocus="autofocus" placeholder="Enter Title">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Category</label>
                        <div class="col-lg-9">
                            <?php echo form_dropdown("cbo_category_id", $category_id, set_value('cbo_category_id'), "class='form-control' id='cbo_category_id'"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Keyword</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_keyword" class="form-control" value="<?php echo set_value('txt_keyword'); ?>" placeholder="Enter Keyword. Separate with comma (,)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Preface</label>
                        <div class="col-lg-9">
                            <textarea name="txt_preface" id="txt_detail" class="txt_preface form-control" placeholder="Input preface"><?php echo set_value('txt_preface'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Detail</label>
                        <div class="col-lg-9">
                            <textarea name="txt_detail" id="txt_detail" class="txt_detail form-control" placeholder="Input your Network Detail"><?php echo set_value('txt_detail'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Image</label>
                        <div class="col-lg-5">
                            <input type="file"  class="form-control" id="uploadimage" name="uploadimage" value="<?php echo set_value('image'); ?>"/>
                            (730 x 486) and File Type .jpg, .jpeg, .png
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
    function send_data(main) {
        image = $('#image').val();
        //var value = image + main + ';';
        var value = main;
        $('#image').val(value);
        $('#myModal').modal('hide');
<?php foreach ($list_directory as $dir) { ?>
            $('#myModal<?php echo $dir->id; ?>').modal('hide');
<?php } ?>
    }
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
            {title: 'Test template 1', story: 'Test 1'},
            {title: 'Test template 2', story: 'Test 2'}
        ]
    });

</script>