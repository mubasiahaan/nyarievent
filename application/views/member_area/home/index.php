
<div class="col-lg-10 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                Home
            </h4>
        </div>

        <div class="panel-body">
            <h4>
                Welcome to Member Area Page
            </h4>
            <div class="panel panel-default">
                <div class="panel-heading">
                    List Inbox Pending
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example" <?php echo empty($list_data) ? '' : 'id="dataTables"'; ?>>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Subjek</th>
                                    <th>Insert User</th>
                                    <th>User Type</th>
                                    <th>Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Responds</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($list_data_inbox as $rst) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $rst->subject; ?></td>
                                        <td><?php echo $rst->name; ?></td>
                                        <td><?= ($rst->gold_expired >= date("Y-m-d")) ? "Gold" : "Regular"; ?></td>
                                        <td><?php echo $rst->insert_date; ?></td>
                                        <td><?php echo $list_status[$rst->status]; ?></td>
                                        <td><?php echo ($rst->respon_status == 1) ? "Waiting Client response" : "Waiting Admin Response"; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('member_area/ticket_detail/index/' . $rst->id); ?>" title="Detail Response" class="tip"><span class="icon12 icomoon-icon-list"></span></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel-heading">
                    List Event Pending
                </div>
                <div class="panel-body">
                    <?php echo empty($info_messages) ? '' : $info_messages; ?>
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" <?php echo empty($list_data) ? '' : 'id="dataTables"'; ?>>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Category</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($list_data_event)) { ?>
                                    <tr>
                                        <td colspan="5">No <?php echo 'Event'; ?> Registered</td>
                                    </tr>
                                <?php } ?>
                                <?php
                                $i = 1;
                                $active_menu = "Event";
                                foreach ($list_data_event as $rst) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $rst->title; ?></td>
                                        <td><?php echo $status[$rst->status]; ?></td>
                                        <td><?php echo $category_id[$rst->category_id]; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('member_area/event/update/' . $rst->id); ?>" title="Edit <?= $active_menu; ?>" class="tip btn btn-wht"><span class="icon12 icomoon-icon-pencil"></span> Edit</a>
                                            <a href="<?php echo site_url('member_area/event/delete/' . $rst->id); ?>" title="Remove<?= $active_menu; ?>" class="tip btn btn-wht"><span class="icon12 icomoon-icon-remove"></span> Remove</a>
                                            <a href="<?php echo site_url('member_area/event/detail/' . $rst->id); ?>" title="Detail <?= $active_menu; ?>" class="tip btn btn-wht"><span class="icon12 icomoon-icon-screen-2"></span> View</a>
                                            <a href="<?php echo site_url('member_area/share_moment_comment/index/' . $rst->id . '/' . urlencode($rst->title)); ?>" title="List Commended <?= $active_menu; ?>" class="tip btn btn-wht"><span class="icon12 icomoon-icon-equalizer-2"></span> Comment</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel-heading">
                    List Share Moment Pending
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" <?php echo empty($list_data) ? '' : 'id="dataTables"'; ?>>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($list_data_story)) { ?>
                                    <tr>
                                        <td colspan="5">No <?php echo $active_menu; ?> Registered</td>
                                    </tr>
                                <?php } ?>
                                <?php
                                $i = 1;
                                $active_menu = "Share Moment";
                                foreach ($list_data_story as $rst) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $rst->title; ?></td>
                                        <td><?php echo $status[$rst->status]; ?></td>
                                        <td><?php echo $category_id[$rst->category_id]; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo site_url('member_area/share_moment/update/' . $rst->id); ?>" title="Edit <?= $active_menu; ?>" class="tip btn btn-wht"><span class="icon12 icomoon-icon-pencil"></span> Edit</a>
                                            <a href="<?php echo site_url('member_area/share_moment/delete/' . $rst->id); ?>" title="Remove<?= $active_menu; ?>" class="tip btn btn-wht"><span class="icon12 icomoon-icon-remove"></span> Remove</a>
                                            <a href="<?php echo site_url('member_area/event/detail/' . $rst->id); ?>" title="Detail <?= $active_menu; ?>" class="tip btn btn-wht"><span class="icon12 icomoon-icon-screen-2"></span> View</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>

    </div>
</div>
</div>
</div>


<script src="<?= ASSETS_PATH; ?>js/demo.js"></script>
<script src="<?= ASSETS_PATH; ?>js/jquery.dataTables.min.js"></script>
<script src="<?= ASSETS_PATH; ?>js/dataTables.bootstrap.min.js"></script>


<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
