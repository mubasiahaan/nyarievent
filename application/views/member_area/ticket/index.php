
<div class="col-lg-10 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <span><?php echo $active_menu; ?></span><a href="<?php echo site_url('member_area/ticket/add/'); ?>" class="btn btn-success pull-right"><span class="icon16 icomoon-icon-list"></span>Add <?php echo $active_menu; ?></a>
            </h4>
        </div>
        <div class="panel-body dafter">
            <div class="panel-body">
                <?php
                foreach ($list_status as $key => $value) {
                    if ($key == $status) {
                        echo $value;
                    } else {
                        ?>
                        <a href="<?php echo site_url('member_area/' . $controler . '/index/status/' . $key); ?>" class="tip btn btn-xs btn-success" title="Edit"><span class="glyphicon glyphicon-list"></span> <?= $value; ?></a>
                        <?php
                    }
                }
                ?>
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
                            foreach ($list_data as $rst) {
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
                                        <a href="<?php echo site_url('member_area/ticket_detail/index/' . $rst->id); ?>" title="Detail <?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-list"></span></a>
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
    </div>
</div>


