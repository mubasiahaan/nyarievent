<section>
    <div class="col-lg-12">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span>About <?= $app_name ;?></span>
                </h4>
            </div>
            <div class="panel-body">
                <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                <form class="form-horizontal" action="<?php echo site_url('admin/info'); ?>" method="post" role="form">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Preface</label>
                        <div class="col-lg-9">
                            <textarea name="txt_about_preface" class="form-control" placeholder="Input your Company Preface"><?php echo set_value('txt_about_preface', $about->preface); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Detail</label>
                        <div class="col-lg-9">
                            <textarea name="txt_about_detail" class="txt_detail form-control" placeholder="Input your Company Detail"><?php echo set_value('txt_about_detail', $about->detail); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <input type="submit" name="submit-about" value="Save Change" class="btn btn-info" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>