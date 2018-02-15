<div class="connect ins"></div>
<div class="hdr ins"><img src="<?= ASSETS_PATH; ?>img/h-share.png" alt="" /></div>
<div class="body ins">
    <div class="container">
        <section class="journal read">
            <div class="col-md-12">
                <h2><?= $rec_detail->title; ?></h2>
                <div class="ket">
                    <span class="text-muted"><span class="glyphicon glyphicon-eye-open"></span> <?= $view ?></span> <i>|</i>
                    <a href="<?= site_url('share_moment'); ?>">Share Moment</a>
                </div>
            </div>
        </section>

        <section class="journal">
            <div class="col-md-12">
                <section>
                    <div class="col-md-8">
                        <img src="<?= ASSETS_PATH . 'uploads/images/content/' . $rec_detail->image ?>" class="img-responsive" alt="" />
                        <p><?= $rec_detail->detail; ?></p>
                        <div class="share">
                            <div class="pull-right">
                                <a href="<?= site_url('event') ?>" class="orr">View Event &raquo;</a>
                            </div>
                            <img src="<?= ASSETS_PATH; ?>img/icon-fb.png" alt="" />
                            <img src="<?= ASSETS_PATH; ?>img/icon-twitter.png" alt="" />
                            <img src="<?= ASSETS_PATH; ?>img/icon-google.png" alt="" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php $this->load->view('story/sidebar'); ?>
                    </div>
                </section>
            </div>
        </section>
    </div>
</div>

