<div class="panel panel-blue">
    <div class="panel-heading">
        <h4>
            <span>List Pending Inbox</span>
        </h4>
    </div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example" <?php echo empty($list_data) ? '' : 'id="dataTables"'; ?>>
                <thead>
                    <tr>
                        <th>No</th>
                        <th><?php echo $active_menu; ?> Subjek</th>
                        <th>Insert User</th>
                        <th>User Type</th>
                        <th><?php echo $active_menu; ?> Date</th>
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
                                <a href="<?php echo site_url('admin/ticket_detail/index/' . $rst->id); ?>" title="Reply <?= $active_menu; ?>" class="tip"><span class="glyphicon glyphicon-repeat"></span></a>
                                <a href="<?php echo site_url('admin/ticket/update/' . $rst->id); ?>" title="Edit <?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                <a href="<?php echo site_url('admin/ticket/delete/' . $rst->id); ?>" title="Remove<?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                <?php if ($rst->status != 2) { ?>
                                    <a href="<?php echo site_url('admin/ticket/approve/' . $rst->id); ?>" title="Close <?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-thumbs-up-3"></span></a>
                                <?php } else { ?>
                                    <a href="<?php echo site_url('admin/ticket/reject/' . $rst->id); ?>" title="Open <?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-exit"></span></a>
                                    <?php } ?>

                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
</div>

