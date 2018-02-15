
<div class="col-lg-10 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <span><?php echo $active_menu; ?></span>
            </h4>
        </div>
        <div class="panel-body">
            <p><?= $rec_gold->detail ?></p>
            <a href="<?php echo site_url('member_area/upgrade/add/'); ?>" class="btn btn-success"><span class="icon16 icomoon-icon-arrow-right-2"></span>Confirm Now</a>
        </div>
        <div class="panel-body dafter">
            <div class="panel-body">
                History Confirmation
                <?php echo empty($info_messages) ? '' : $info_messages; ?>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($list_data as $rst) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rst->transfer_date; ?></td>
                                    <td><?php echo $rst->total; ?></td>
                                    <td><?php echo $rst->validation; ?></td>
                                    <td><?php echo $rst->account; ?></td>
                                    <td><?php echo $rst->name; ?></td>
                                    <td><?php echo $list_status[$rst->status]; ?></td>
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


