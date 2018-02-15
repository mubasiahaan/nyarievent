<div class="panel panel-blue">
    <div class="panel-heading">
        <h4>
            <span>List Pending Gold Member</span>
        </h4>
    </div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example" <?php echo empty($list_data) ? '' : 'id="dataTables"'; ?>>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date Transfer</th>
                        <th>Total</th>
                        <th>Validation</th>
                        <th>account</th>
                        <th>Insert User</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($list_data_upgrade as $rst) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $rst->transfer_date; ?></td>
                            <td><?php echo $rst->total; ?></td>
                            <td><?php echo $rst->validation; ?></td>
                            <td><?php echo $rst->account; ?></td>
                            <td><?php echo $rst->name; ?></td>
                            <td><?php echo $list_status[$rst->status]; ?></td>

                            <td class="text-center">
                                <a href="<?php echo site_url('admin/gold_confirm/update/' . $rst->id); ?>" title="Edit <?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                <a href="<?php echo site_url('admin/gold_confirm/delete/' . $rst->id); ?>" title="Remove<?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                <?php if ($rst->status != 2) { ?>
                                    <a href="<?php echo site_url('admin/gold_confirm/approve/' . $rst->id); ?>" title="Approve<?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-thumbs-up-3"></span></a>
                                <?php } else { ?>
                                    <a href="<?php echo site_url('admin/gold_confirm/reject/' . $rst->id); ?>" title="Reject<?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-exit"></span></a>
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