<section>
    <?php echo empty($info_messages) ? '' : $info_messages; ?>
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span><?php echo $active_menu; ?></span><a href="<?php echo site_url('admin/event_comment/add/' . $rec_data->id); ?>" class="btn btn-success pull-right"><span class="icon16 icomoon-icon-list"></span>Add <?php echo $active_menu; ?></a>
                </h4>
            </div>
            <div class="panel-body">

                <div class="dataTable_wrapper">
                    <form class="form-horizontal" action="<?php echo site_url('admin/' . $controler . '/update/' . $rec_data->id); ?>" method="post" role="form">
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="focus">Title</label>
                            <div class="col-lg-9">
                                <?php echo$rec_data->title; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="focus">Category</label>
                            <div class="col-lg-9">
                                <?php echo $category_id[$rec_data->category_id]; ?>  
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="focus">Detail</label>
                            <div class="col-lg-9">
                                <?php echo$rec_data->detail; ?>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" <?php echo empty($list_data) ? '' : 'id="dataTables"'; ?>>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th><?php echo $active_menu; ?> Detail</th>
                                <th><?php echo $active_menu; ?> User</th>
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
                                    <td><?php echo $rst->detail; ?></td>
                                    <td><?php echo $rst->insert_user; ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo site_url('admin/event_comment/update/' . $rst->id); ?>" title="Edit <?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
                                        <a href="<?php echo site_url('admin/event_comment/delete/' . $rst->id . '/' . $rst->event_id); ?>" title="Remove<?= $active_menu; ?>" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>                                      
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