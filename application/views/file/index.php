<div class="container">
    <section class="clearfix">
        <div class="col-md-12 pad0">
            <a href="#">
                <h2 class="panel-header-text"><span>FILE</span></h2>
            </a>
            <div class="dvd"></div>
        </div>
    </section>
</div>
<div class="main">
    <div class="container mar-btm30">
        <section class="clearfix">
            <div class="col-md-12">
                <form class="alert alert-danger" action="<?php echo site_url('file/search'); ?>" method="post" role="form">
                    <div class="form-group clearfix">
                        <label class="col-lg-1 col-md-2"><p>Search :</p></label>

                        <div class="col-lg-11 col-md-10">
                            <input type="text" name="txt_search" class="form-control" placeholder="Search here..">
                        </div>
                    </div>
                </form>
            </div>
            <?php foreach ($list_file as $key => $value) { ?>
                <div class="col-md-6">
                    <div class="arc mar-top15">
                        <h2><?= strtoupper($list_file[$key]['name']); ?></h2>
                        <ul class="list-group list-cat list-pdf">
                            <?php foreach ($list_file[$key]['detail'] as $row) { ?>
                                <li>
                                    <a href="<?php echo UPLOADED_PATH . 'file/' . $row->file_name; ?>">
                                        <h3><?php echo $row->title; ?>
                                            <span>| <?php echo date_format(date_create($row->insert_date), "M d, Y"); ?></span></h3>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                        <a href="<?= site_url('file/detail/' . $key) ?>" class="btn btn-danger">View all &rarr;</a>
                    </div>
                </div>
            <?php } ?>
        </section>
    </div>
</div>