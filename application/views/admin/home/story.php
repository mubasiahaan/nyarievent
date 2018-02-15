<div class="panel panel-blue">
    <div class="panel-heading">
        <h4>
            <span>List Pending Share Moment</span>
        </h4>
    </div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example" <?php echo empty($list_data) ? '' : 'id="dataTables"'; ?>>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Insert User</th>
                        <th>User Type</th>
                        <th class="text-center">Status</th>
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
                    foreach ($list_data_story as $rst) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $rst->title; ?></td>
                            <td><?php echo $category_id[$rst->category_id]; ?></td>
                            <td><?php echo $rst->name; ?></td>
                            <td><?= ($rst->gold_expired >= date("Y-m-d")) ? "Gold" : "Regular"; ?></td>
                            <td><?php echo $list_status[$rst->status]; ?></td>
                            <td class="text-center">
                                <a href="<?php echo site_url('admin/story/update/' . $rst->id); ?>" title="Edit <?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                <a href="<?php echo site_url('admin/story/delete/' . $rst->id); ?>" title="Remove<?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                <?php if ($rst->status != 2) { ?>
                                    <a href="<?php echo site_url('admin/story/approve/' . $rst->id); ?>" title="Approve<?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-thumbs-up-3"></span></a>
                                <?php } else { ?>
                                    <a href="<?php echo site_url('admin/story/reject/' . $rst->id); ?>" title="Reject<?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-exit"></span></a>
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