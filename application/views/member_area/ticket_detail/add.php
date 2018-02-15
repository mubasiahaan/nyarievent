
<div class="col-lg-10 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <span>Add <?php echo $active_menu; ?></span>
            </h4>
        </div>
        <div class="panel-body dafter">
           <div class="panel-body">
                <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                <form class="form-horizontal" action="<?php echo site_url('member_area/ticket/add/'); ?>" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Inbox Subjek</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_subject" class="form-control" value="<?php echo set_value('txt_subject'); ?>" autofocus="autofocus" placeholder="Enter Subject">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Detail</label>
                        <div class="col-lg-9">
                            <textarea name="txt_detail" rows="30" id="txt_detail" class="txt_detail form-control" placeholder="Input your  Detail"><?php echo set_value('txt_detail'); ?></textarea>
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
</div>
<?php $this->load->view('member_area/modal'); ?>


<script>
$('#datepick').datepicker({
   format: 'yyyy-mm-dd',
});
</script>
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
            {title: 'Test template 1', event: 'Test 1'},
            {title: 'Test template 2', event: 'Test 2'}
        ]
    });

</script>