<section>
    <div class="col-lg-12">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span>Contact</span>
                </h4>
            </div>
            <div class="panel-body">
                <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                <form class="form-horizontal" action="<?php echo site_url('admin/info'); ?>" method="post" role="form">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Address</label>
                        <div class="col-lg-9">
                            <textarea name="txt_address" class="form-control" placeholder="Input your Company Address"><?php echo set_value('txt_address', $contact['address']); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">City</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="Input your City" name="txt_city" value="<?php echo set_value('txt_city', $contact['city']); ?>" />
                        </div>
                        <label class="col-lg-1 control-label" for="focus">Country</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="Input your Country" name="txt_country" value="<?php echo set_value('txt_country', $contact['country']); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Phone</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="Input your Phone" name="txt_phone" value="<?php echo set_value('txt_phone', $contact['phone']); ?>" />
                        </div>
                        <label class="col-lg-1 control-label" for="focus">Email</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="Input your Email" name="txt_email" value="<?php echo set_value('txt_email', $contact['email']); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Facebook</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="Input your Facebook" name="txt_fb" value="<?php echo set_value('txt_fb', $contact['fb']); ?>" />
                        </div>
                        <label class="col-lg-1 control-label" for="focus">Twitter</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="Input your Google Plus" name="txt_gp" value="<?php echo set_value('txt_gp', $contact['gplus']); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Fax</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="Input your Fax" name="txt_fax" value="<?php echo set_value('txt_fax', $contact['fax']); ?>" />
                        </div>
                        <label class="col-lg-1 control-label" for="focus">SMS</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" placeholder="Input your SMS Number" name="txt_sms" value="<?php echo set_value('txt_sms', $contact['sms']); ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <input type="submit" name="submit-contact" value="Save Change" class="btn btn-info" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>