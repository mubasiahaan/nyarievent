<section>
    <div class="col-lg-6">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span>Update Company</span>
                </h4>
            </div>
            <div class="panel-body">
                <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                <form class="form-horizontal" action="<?php echo site_url('admin/company/update/' . $company->id); ?>" method="post" role="form">
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="focus">Company Name</label>
                        <div class="col-lg-9">
                            <input type="text" name="txt_company" class="form-control" value="<?php echo set_value('txt_company', $company->name) ?>" autofocus="autofocus" placeholder="Enter Company Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="select">Parent Company</label>
                        <div class="col-lg-9">
                            <select name="cmb_company" class="form-control">
                                <?php
                                foreach ($parent_company as $row) {
                                    $selected = $row['id'] == $company->parent_id ? true : false;
                                    ?>
                                    <option value="<?php echo $row['id']; ?>" <?php echo $selected ? 'selected="selected"' : ''; ?>><?php echo $row['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label" for="select">Theme</label>
                        <div class="col-lg-9">
                            <select name="cmb_theme" class="form-control">
                                <option value="default">Default</option>
                                <option value="blue">Blue</option>
                                <option value="yellow">Yellow</option>
                                <option value="red">Red</option>
                                <option value="green">Green</option>
                            </select>
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