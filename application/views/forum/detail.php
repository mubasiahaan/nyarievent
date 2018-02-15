
<div class="container">
    <section class="clearfix">
        <div class="col-md-12 pad0">
            <a href="#">
                <h2 class="panel-header-text"><span>NEWS &rarr;</span>  <?= strtoupper($list_category_news[$rec_detail->category_id]) ?></h2>
            </a>
            <div class="dvd"></div>
        </div>
    </section>
</div>
<div class="main">
    <div class="container">
        <section class="clearfix">
            <div class="col-md-8">
                <div class="arc mar-top15">
                    <h1><?= $rec_detail->title; ?></h1>
                    <p><span class="glyphicon glyphicon-calendar"></span> <?php echo date_format(date_create($rec_detail->insert_date), "M d, Y"); ?></p>
                    <img src="<?php echo IMG_UPLOADED_MAIN . '/' . $rec_detail->image; ?>" class="img-responsive" /><br/>
                    <?= $rec_detail->detail; ?> </p>
                </div>
                <div class="share">
                    Share: <img src="<?php echo IMG_PATH; ?>/ico-fb.gif" alt="" /> <img src="<?php echo IMG_PATH; ?>/ico-twitter.gif" alt="" />
                </div>
            </div>
            <div class="col-md-4 arc">
                <?php $this->load->view('news/sidebar'); ?>

            </div>
        </section>
    </div>
</div>