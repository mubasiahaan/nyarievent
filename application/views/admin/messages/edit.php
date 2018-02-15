<section>
    <div class="col-lg-12">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span>Update Article</span>
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
                <form class="form-horizontal" action="<?php echo site_url('admin/slider/update/id/' . $cont_update->id); ?>" method="post" role="form">
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Name</label>
                        <div class="col-lg-11">
                            <?php echo form_input(array('name' => 'txt_name', 'id' => 'name', 'class' => 'form-control', 'value' => !empty($cont_update->name) ? $cont_update->name : set_value('txt_name'))); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Link</label>
                        <div class="col-lg-11">
                            <?php echo form_input(array('name' => 'txt_link', 'id' => 'link', 'class' => 'form-control', 'value' => !empty($cont_update->link) ? $cont_update->link : set_value('txt_link'))); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Order</label>
                        <div class="col-lg-11">
                            <?php echo form_input(array('name' => 'txt_order', 'id' => 'order', 'class' => 'form-control', 'value' => !empty($cont_update->order) ? $cont_update->order : set_value('txt_order'))); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Status</label>
                        <div class="col-lg-11">
                            <?php echo form_dropdown("cbo_status", $list_status, !empty($cont_update->status) ? $cont_update->status : set_value('cbo_status'), "class='form-control' id='category'"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Image</label>
                        <div class="col-lg-11">
                            <img src="<?php
                            echo!empty($cont_update->file_name) ? BASE_URL . '/assets/uploads/images/slider/' . $cont_update->file_name : "";
                            ?>" alt="" class="img-responsive" />
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
        var value = main + ';';
        $('#image').val(value);
        $('#myModal').modal('hide');
    }
</script>
<script>
    // Tiny MCE
    tinymce.init({
        selector: "#txt_detail",
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
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <?php foreach ($list_image as $row) { ?>
            <a class="info" title ="Choose Image" href="#" onclick="send_data('<?php echo $row->path; ?>')">
                <img src="<?php echo IMG_UPLOADED_THUMBS . $row->path; ?>" />
            </a>
        <?php } ?>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Save changes</button>
    </div>
</div>