<section>
    <?php echo empty($info_messages) ? '' : $info_messages; ?>
    <div class="col-lg-10 col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span><?php echo $active_menu; ?></span><a href="<?php echo site_url('member_area/share_moment/add/'); ?>" class="btn btn-success pull-right"><span class="icon16 icomoon-icon-list"></span>Add <?php echo $active_menu; ?></a>
                </h4>
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" <?php echo empty($list_data) ? '' : 'id="dataTables"'; ?>>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $active_menu; ?> Name</th>
                                <th><?php echo $active_menu; ?> Category</th>
                                <th> Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($list_data)) { ?>
                                <tr>
                                    <td colspan="5">No <?php echo $active_menu; ?> Registered</td>
                                </tr>
                            <?php } ?>
                            <?php
                            $i = 1;
                            foreach ($list_data as $rst) {
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rst->title; ?></td>
                                    <td><?php echo $status[$rst->status]; ?></td>
                                    <td><?php echo $category_id[$rst->category_id]; ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo site_url('member_area/share_moment/update/' . $rst->id); ?>" title="Edit <?= $active_menu; ?>" class="tip btn btn-wht"><span class="icon12 icomoon-icon-pencil"></span> Edit</a>
                                        <a href="<?php echo site_url('member_area/share_moment/delete/' . $rst->id); ?>" title="Remove<?= $active_menu; ?>" class="tip btn btn-wht"><span class="icon12 icomoon-icon-remove"></span> Remove</a>
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
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</section>