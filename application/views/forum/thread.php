
<div class="container">
    <section class="clearfix">
        <div class="col-md-12 pad0">
            <a href="<?= site_url('forum'); ?>">
                <h2 class="panel-header-text"><span>FORUM &rarr;</span>  </h2>
            </a> <?= $rec_detail->title ?>
            <div class="dvd"></div>
        </div>
    </section>
</div>
<div class="main">
    <div class="container">
        <section class="clearfix mar-top15">
            <div class="col-md-12">
                <a href="#" class="btn btn-danger">Post Reply <span class="glyphicon glyphicon-send"></span></a>
            </div>
        </section>
        <table class="table table-striped mar-top15">
            <thead>
                <tr>
                    <th colspan="2" class="poin">
                        <span class="pull-left">
                            18 August 2014 - 15:24:47
                        </span>
                        <span class="pull-right">
                            # 1
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td-main width150 user-background text-center">
                        <img src="<?= print_avatar($rec_detail->insert_user); ?>" class="img-responsive" />
                        <a href="#" class="margin-top10">User01</a>
                        <div class="text-danger">User</div>
                    </td>
                    <td class="td-main">
                        <p><?= $rec_detail->detail ?> </p>
                        <hr class="margin-top50" />
                        Your Quotes here. Warung Hukum.                                
                    </td>
                </tr>
            </tbody>
        </table>
        <?php
        $i = 1;
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
            <form class="form-horizontal" action="<?php echo site_url('forum/thread/' . $rec_detail->id); ?>" method="post" role="form">
                <table class="table table-striped mar-top15">
                    <thead>
                        <tr>
                            <th colspan="2" class="poin">
                                Reply Post
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

<script>
    // Tiny MCE
    tinymce.init({
        selector: ".txt_detail",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', news: 'Test 1'},
            {title: 'Test template 2', news: 'Test 2'}
        ]
    });

</script>