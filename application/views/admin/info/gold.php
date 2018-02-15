<section>
    <div class="col-lg-12">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span>Gold Message And Price</span>
                </h4>
            </div>
            <div class="panel-body">
                <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                <form class="form-horizontal" action="<?php echo site_url('admin/info'); ?>" method="post" role="form">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Detail</label>
                        <div class="col-lg-9">
                            <textarea name="txt_gold_detail" class="txt_detail form-control" placeholder="Input faq preface"><?php echo set_value('txt_faq_detail', $gold->detail); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <input type="submit" name="submit-gold" value="Save Change" class="btn btn-info" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>