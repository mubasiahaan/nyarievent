<div class="panel-body">
    <form class="form-horizontal" action="<?php echo site_url('site_config'); ?>" role="form">
        <div class="form-group">
            <label class="col-lg-2 control-label" for="normalInput">Application Name</label>
            <div class="col-lg-9">
                <input autofocus="autofocus" type="text" name="txt_app_name" class="form-control" value="<?php echo set_value('txt_app_name', $app_name); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" for="normalInput">Author</label>
            <div class="col-lg-9">
                <input  type="text" name="txt_app_author" class="form-control" value="<?php echo set_value('txt_app_author', $app_meta[1]['content']); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" for="normalInput">Application Title</label>
            <div class="col-lg-9">
                <input  type="text" name="txt_app_title" class="form-control" value="<?php echo set_value('txt_app_title', $app_meta[2]['content']); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" for="normalInput">Application Description</label>
            <div class="col-lg-9">
                <input  type="text" name="txt_app_desc" class="form-control" value="<?php echo set_value('txt_app_desc', $app_meta[3]['content']); ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label" for="normalInput">Keyword</label>
            <div class="col-lg-9">
                <input  type="text" name="txt_app_keyword" class="form-control" value="<?php echo set_value('txt_app_keyword', $app_meta[4]['content']); ?>">
                <p>*Pisahkan dengan tanda koma (,)</p>
            </div>
        </div>
<!--        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-9">
                <button type="submit" class="btn btn-info">Save changes</button>
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>-->
    </form>
</div>