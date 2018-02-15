<h4 class="mar0 text-muted">Related Moment</h4><br/>
<?php foreach ($rec_related as $row) { ?>
    <section class="journal">
        <a href="<?php echo site_url('share_moment/detail/' . $row->id); ?>">
            <div class="col-md-6 pad0">
                <img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" class="img-responsive" alt="" />
            </div>
            <div class="col-md-6">
                <h3><?php echo $row->title; ?></h3>
            </div>
        </a>
    </section>
<?php } ?> 
