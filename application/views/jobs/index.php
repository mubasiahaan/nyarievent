<div class="container">
    <section class="clearfix">
        <div class="col-md-12 pad0">
            <a href="#">
                <h2 class="panel-header-text"><span>JOBS</span></h2>
            </a>
            <div class="dvd"></div>
        </div>
    </section>
</div>
<div class="main">
    <div class="container mar-btm30">
        <section class="clearfix">
            <?php foreach ($list_jobs as $row) { ?>
                <div class="col-md-6">
                    <div class="arc mar-top15">
                        <h2><?= $row->title; ?></h2>
                        <p><?= $row->detail; ?></p>
                    </div>
                </div>
            <?php } ?>
        </section>
    </div>
</div>