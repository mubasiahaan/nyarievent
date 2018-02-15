<h4><span class="glyphicon glyphicon-list"></span> Related Article</h4>
<section class="clearfix">
    <?php foreach ($rec_related as $row) { ?>
    <div class="col-sm-12">
        <a href="<?php echo site_url('news/detail/' . $row->id); ?>">
            <div class="caption">
                <small><?php echo date_format(date_create($row->insert_date), "M d, Y"); ?></small>
                <h2><?php echo $row->title; ?></h2>
            </div>
            <img src="<?php echo IMG_UPLOADED_MAIN . '/' . $row->image; ?>" class="img-responsive" />
        </a>
    </div>
    <?php } ?> 
</section>