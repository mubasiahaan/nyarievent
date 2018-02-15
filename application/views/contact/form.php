<div class="contact">
    <h3>Leave Message</h3>
	<hr/>
    <form action="<?php echo site_url('contact'); ?>" method="post" role="form">
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