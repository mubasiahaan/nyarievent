
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
        <?php
        $i = 0;
        foreach ($rec_comment as $row) {
            $i++;
            ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="2" class="poin">
                            <span class="pull-left">
                                <?php echo date_format(date_create($row->insert_date), "d M Y - h:i:s"); ?>
                            </span>
                            <span class="pull-right">
                                # <?= $i ?>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td-main width150 user-background text-center">
                            <img src="<?= print_avatar($row->insert_user); ?>" class="img-responsive" />
                            <a href="#" class="margin-top10"><?= $row->username ?></a>
                            <div class="text-danger"><?= $row->name ?></div>
                        </td>
                        <td class="td-main">
                            <?= $row->detail ?></p>
                            <hr class="margin-top50" />
                            <?= $row->qoutes ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php } ?>
        <?php if ($this->session->userdata('sess-loggedin')) { ?>
            <form class="form-horizontal" action="<?php echo site_url('news/detail/' . $rec_detail->id); ?>" method="post" role="form">
                <table class="table table-striped mar-top15">
                    <thead>
                        <tr>
                            <th colspan="2" class="poin">
                                Post Commment
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="td-main">
                                <textarea name="txt_detail" id="txt_detail" class="txt_detail form-control" placeholder="Input your Network Detail"></textarea>                          
                            </td>
                        </tr>
                    </tbody>
                </table>
                <section class="clearfix">
                    <div class="col-md-12 mar-btm30">
                        <input type="submit" name="submit" value="Post Reply  " class="btn btn-danger" />
                    </div>
                </section>
            </form>
        <?php } else { ?>
            <section class="clearfix">
                <div class="col-md-12 mar-btm30">
                    <a href="<?php echo site_url('login'); ?>" class="btn btn-danger">Log In to Post </a>
                    <a href="<?php echo site_url('login/register'); ?>" class="btn btn-danger">Register </a>
                </div>
            </section>

        <?php } ?>
    </div>
</div>