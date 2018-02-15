
<section>
    <div class=" col-lg-10">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>Update Image</span>
                </h4>
            </div>
            <div class="panel-body">
                <?php
                if (isset($error_messages))
                    echo $error_messages;
                ?>

                <form class="form-horizontal jc-margin-right" role="form" method="post"
                      action="<?php echo site_url('member_area/gallery/edit/' . $cat_id); ?>"
                      enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Caption*</label>
                        <div class="col-lg-4">
                            <input type="text" name="tx_caption" class="form-control" value="<?php echo!empty($rec_data->caption) ? $rec_data->caption : set_value('tx_caption'); ?>" placeholder="Image Caption"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Category*</label>
                        <div class="col-lg-4">
                            <?php echo form_dropdown("category", $category_id, !empty($rec_data->category) ? $rec_data->category :set_value('category'), "class='form-control' id='category'"); ?>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus">Image Update</label>
                        <div class="col-lg-4">
                            <img src="<?php echo IMG_UPLOADED_MAIN . '/' . $rec_data->path; ?>" class="img-responsive" alt="" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-1 control-label" for="focus"></label>
                        <div class="col-lg-4">
                            <input type="submit" class="btn btn-info" name="submit" value="Save" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>