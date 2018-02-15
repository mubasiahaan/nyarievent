<div class="container">
    <section class="clearfix">
        <div class="col-md-12 pad0">
            <a href="#">
                <h2 class="panel-header-text"><span>FORUM</span></h2>
            </a>
            <div class="dvd"></div>
        </div>
    </section>
</div>
<div class="main">
    <div class="container">
        <section class="clearfix mar-top15">
            <div class="col-lg-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="poin">
                                POPULAR THREADS (on last 30 days)
                            </th>
                            <th class="hidden-xs">
                                Replies
                            </th>
                            <th class="hidden-xs">
                                Last Post
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($forum_popular as $row) { ?>
                            <tr>
                                <td class="td-main">
                                    <div class="pull-left"><img src="<?php echo IMG_PATH; ?>/57777.png" /></div>
                                    <a href="<?= site_url('forum/thread/' . $row->id) ?>"><?= $row->title; ?></a>
                                    Started by <?= $row->started_user ?>, <?php echo date_format(date_create($row->insert_date), "M d, Y"); ?>
                                </td>
                                <td class="text-center hidden-xs">
                                    <?= $row->total_replies ?>
                                </td>
                                <td class="td-main hidden-xs">
                                    <a href="#"><?= $row->last_replies_user_name ?></a>
                                    <?php echo date_format(date_create($row->last_replies_date), "M d, Y"); ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </section>

        <?php foreach ($list_forum as $list_f) { ?>
            <section class="clearfix">
                <div class="col-lg-12">
                    <a href="#">
                        <h3 class="panel-header-text">Category Forum <?= $list_f['name'] ?></h3>
                    </a>
                    <div class="dvd"></div>
                </div>
            </section>
            <section class="clearfix mar-top15">
                <div class="col-lg-12">
                    <table class="table table-striped table-grey">
                        <thead>
                            <tr>
                                <th class="poin">
                                    LATEST THREADS
                                </th>
                                <th class="hidden-xs">
                                    Replies
                                </th>
                                <th class="hidden-xs">
                                    Last Post
                                </th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php foreach ($list_f['forum'] as $row) { ?>
                                <tr>
                                    <td class="td-main">
                                        <div class="pull-left"><img src="<?php echo IMG_PATH; ?>/57777.png" /></div>
                                        <a href="<?= site_url('forum/thread/' . $row->id) ?>"><?= $row->title; ?></a>
                                        Started by <?= $row->started_user ?>, <?php echo date_format(date_create($row->insert_date), "M d, Y"); ?>
                                    </td>
                                    <td class="text-center hidden-xs">
                                        <?= $row->total_replies ?>
                                    </td>
                                    <td class="td-main hidden-xs">
                                        <a href="#"><?= $row->last_replies_user_name ?></a>
                                        <?php echo date_format(date_create($row->last_replies_date), "M d, Y"); ?>
                                    </td>
                                </tr>
                            <?php } ?>


                        </tbody>
    <!--                    <tfoot>
                            <tr>
                                <td colspan="3">
                                    <nav class="text-center" aria-label="Page navigation">
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
                                    </nav>
                                </td>
                            </tr>
                        </tfoot>-->
                    </table>
                </div>
            </section>
        <?php } ?>


        <section class="clearfix mar-top15">
            <div class="col-lg-12">

                <?php if ($this->session->userdata('sess-loggedin')) { ?>
                    <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                    <form class="form-horizontal" action="<?php echo site_url('forum/index'); ?>" method="post" role="form">
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
                                    <td>Thread Name</td>
                                    <td class="td-main">
                                        <textarea name="txt_title" id="txt_title" class="txt_title form-control" placeholder="Input thread name"></textarea>                          
                                    </td>
                                </tr>

                                <tr>
                                    <td>Thread Category</td>
                                    <td class="td-main">
                                        <?php echo form_dropdown("cbo_category_id", $category_id, set_value('cbo_category_id'), "class='form-control' id='cbo_category_id'"); ?>                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Detail</td>
                                    <td class="td-main">
                                        <textarea name="txt_detail" id="txt_detail" class="txt_detail form-control" placeholder="Input your Network Detail"></textarea>                          
                                    </td>
                                </tr>
                                <tr>

                                    <td colspan="2"  class="td-main">
                                        <input type="submit" name="submit" value="Post Thread  " class="btn btn-danger" />                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </form>
                <?php } else { ?>
                    <section class="clearfix">
                        <div class="col-md-12 mar-btm30">
                            <a href="<?php echo site_url('login'); ?>" class="btn btn-danger">Log In  </a>
                            <a href="<?php echo site_url('login/register'); ?>" class="btn btn-danger">Register to Post Thread</a>
                        </div>
                    </section>

                <?php } ?>

            </div>
        </section>
    </div>
</div>
<div class="container">
    <section class="mar-top30">
        <div class="col-md-6">
            <table class="table table-striped">
                <thead class="header-grey">
                    <tr>
                        <th class="poin">
                            GENERAL
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="td-main">
                            <?= $rec_info->detail; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
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