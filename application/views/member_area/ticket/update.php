<?php $this->load->view('member_area/modal'); ?>
<section>
    <div class="col-lg-10">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span><?= $page_title; ?></span>
                </h4>
            </div>
            <div class="panel-body">
                <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                <form class="form-horizontal" action="<?php echo site_url('member_area/event/update/' . $rec_data->id); ?>" method="post" role="form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Event Name</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_name" class="form-control" value="<?php echo set_value('txt_name', $rec_data->title); ?>" autofocus="autofocus" placeholder="Enter Network Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Category</label>
                        <div class="col-lg-9">
                            <?php echo form_dropdown("cbo_category_id", $category_id, set_value('cbo_category_id', $rec_data->category_id), "class='form-control' id='parent_id'"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">City</label>
                        <div class="col-lg-9">
                            <?php echo form_dropdown("cbo_city_id", $city_id, set_value('cbo_city_id', $rec_data->city_id), "class='form-control' id='parent_id'"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Address</label>
                        <div class="col-lg-9">
                            <textarea name="txt_location" rows="4" id="txt_location" class="txt_preface form-control" placeholder="Input your location"><?php echo set_value('txt_location', $rec_data->location); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Position :</label>
                        <label class="col-lg-1 control-label" for="focus">latitude</label>
                        <div class="col-lg-2">
                            <input type="text" name="txt_latitude" class="form-control" value="<?php echo set_value('txt_latitude', $rec_data->latitude); ?>" placeholder="Enter latitude from gmaps">
                        </div>
                        <label class="col-lg-1 control-label" for="focus">longitude</label>
                        <div class="col-lg-2">
                            <input type="text" name="txt_longitude" class="form-control" value="<?php echo set_value('txt_longitude', $rec_data->longitude); ?>" placeholder="Enter longitude from gmaps">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Preface</label>
                        <div class="col-lg-9">
                            <textarea name="txt_preface" rows="4" id="txt_preface" class="txt_preface form-control" placeholder="Input your preface"><?php echo set_value('txt_preface', $rec_data->preface); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Event Date</label>
                        <div class="col-lg-2">
                            <input type="text" id="datepick"  name="txt_event_date"  class="datepick form-control" value="<?php echo set_value('txt_event_date', $rec_data->event_date); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Detail</label>
                        <div class="col-lg-9">
                            <textarea name="txt_detail" id="txt_detail" rows="30" class="txt_detail form-control" placeholder="Input your preface"><?php echo set_value('txt_detail', $rec_data->detail); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Keyword</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_keyword" class="form-control" value="<?php echo set_value('txt_keyword', $rec_data->keyword); ?>" placeholder="Enter Keyword. Separate with comma (,)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Image</label>
                        <div class="col-lg-5">
                            <img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $rec_data->image) ?>" >
                           
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
            {title: 'Test template 1', event: 'Test 1'},
            {title: 'Test template 2', event: 'Test 2'}
        ]
    });

</script>