<div class="container">
    <section class="clearfix">
        <div class="col-md-12 pad0">
            <a href="#">
                <h2 class="panel-header-text"><span>NEWS &rarr;</span> <?= strtoupper($list_category_news[$key_update]) ?></h2>
            </a>
            <div class="dvd"></div>
        </div>
    </section>
</div>
<div class="main">
    <div class="container">
        <section class="clearfix">
            <div class="col-lg-12 pad0">
                <div class="arc mar-top15">
                    <section class="clearfix">
                        <?php foreach ($rec_data as $row) { ?>
                            <div class="col-sm-4">
                                <a href="<?= site_url('news/detail/' . $row->id) ?>">
                                    <div class="caption">
                                        <small><?php echo date_format(date_create($row->insert_date), "M d, Y"); ?></small>
                                        <h2><?php echo $row->title; ?></h2>
                                    </div>
                                    <img src="<?php echo IMG_UPLOADED_MAIN . '/' . $row->image; ?>" class="img-responsive" />
                                </a>
                            </div>
                        <?php } ?> 
                    </section>
                    <!--                    <nav class="text-center" aria-label="Page navigation">
                                            <ul class="pagination">
                                                <li>
                                                    <a href="#" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>
                                                <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#">5</a></li>
                                                <li>
                                                    <a href="#" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>-->
                </div>
            </div>
        </section>
    </div>
</div>