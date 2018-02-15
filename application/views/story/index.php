
<div class="connect ins"></div>
<div class="hdr ins"><img src="<?= ASSETS_PATH; ?>img/h-share.png" alt="" /></div>
<div class="body ins">
    <div class="container">
        <section class="journal read">
            <div class="col-md-12">
                <h2>Latest Moment</h2>
                <div class="ket">
                    <span class="text-muted"><span class="glyphicon glyphicon-eye-open"></span> 1470</span> <i>|</i>
                    <a href="#">Share Moment</a>
                </div>
            </div>
        </section>

        <section class="journal">

            <?php foreach ($rec_data as $row) { ?>
                <div class="col-md-4">
                    <a href="<?= site_url('share_moment/detail/' . $row->id) ?>">
                        <img src="<?= ASSETS_PATH . 'uploads/images/content/' . str_replace(".jpg", "_thumb.jpg", $row->image) ?>" class="img-responsive" alt="" />
                        <h3><?= $row->title; ?></h3>
                        <p class="text-muted"><?= substr($row->preface, 0, 100); ?>... <span class="date">Read more &raquo;</span></p>                    
                    </a>
                </div>
            <?php } ?> 

        </section>
        <div class="text-center">
            <ul class="pagination">
                <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">prev -</span>
                    </a>
                </li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">- next</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
