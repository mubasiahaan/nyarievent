

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
                <form class="form-horizontal" action="<?php echo site_url('admin/'.$controler.'/add'); ?>" method="post" role="form">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Cateogry Name</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_name" class="form-control" value="<?php echo set_value('txt_name'); ?>" autofocus="autofocus" placeholder="Enter Title">
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