<section>
    <?php echo empty($info_messages) ? '' : $info_messages; ?>
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span><?php echo $active_menu; ?></span><a href="<?php echo site_url('admin/'.$controler.'/add'); ?>" class="btn btn-success pull-right"><span class="icon16 icomoon-icon-list"></span>Add <?php echo $active_menu; ?></a>
                </h4>
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" <?php echo empty($list_data) ? '' : 'id="dataTables"'; ?>>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $active_menu; ?> Name</th>
                             
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
                                    <td><a href="<?php echo site_url('admin/content/index/' . $rst->id . '/' . urlencode($rst->name)); ?>" class="tip"><?php echo $rst->name; ?></a></td>
                                
                                    <td class="text-center">
                                        <a href="<?php echo site_url('admin/'.$controler.'/update/' . $rst->id); ?>" title="Edit <?php echo $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                        <a href="<?php echo site_url('admin/'.$controler.'/delete/' . $rst->id); ?>" title="Remove <?php echo $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>
                                        <a href="<?php echo site_url('admin/'.$controler.'/index/' . $rst->id . '/' . urlencode($rst->name)); ?>" class="tip"><span class="icon12 icomoon-icon-equalizer-2"></span></a>
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