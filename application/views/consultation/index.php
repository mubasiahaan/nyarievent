<div class="main">
    <div class="container mar-btm30">
        <section class="clearfix">
            <div class="col-md-6">
                <div class="arc mar-top15">
                    <h2>CONSULTATION FORM</h2>
                    <p><?= $rec_info->detail; ?></p><br/>
                    <div class="contact">
                        <form action="<?php echo site_url('consultation'); ?>" method="post" role="form">
                            <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                            <div class="form-group">
                                <label>Your Name</label>
                                <input type="text" name="txt_name" class="form-control" placeholder="Name here..">
                            </div>
                            <div class="form-group">
                                <label>Your Email</label>
                                <input type="email" name="txt_email" class="form-control" placeholder="Email here">
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea name="txt_message" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" name="submit" value="submit" class="btn btn-default">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>