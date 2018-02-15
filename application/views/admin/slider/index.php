<section>
    <?php echo empty($info_messages) ? '' : $info_messages; ?>
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span><?php echo $active_menu; ?></span><a href="<?php echo site_url('admin/slider/add'); ?>" class="btn btn-success pull-right"><span class="icon16 icomoon-icon-list"></span>Add <?php echo $active_menu; ?></a>
                </h4>
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if (empty($list_slider)) { ?>
                                <tr class="odd gradeX">
                                    <td class="center"><i>(empty)</i></td>
                                    <td class="center"><i>(empty)</i></td>
                                    <td class="center"><i>(empty)</i></td>
                                    <td class="center"><i>(empty)</i></td>
                                    <td class="center"><i>(empty)</i></td>

                                </tr>
                            <?php } else { ?>
                                <?php foreach ($list_slider as $row) { ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row->id; ?></td>
                                        <td><?php echo $row->name; ?></td>
                                        <td><?php echo $row->link; ?></td>
                                        <td><?php echo ($row->status == 1) ? 'Active' : 'Non Active'; ?></td>
                                        <td><?php echo $row->order; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('admin/slider/detail/id/' . $row->id); ?>" class="badge badge-info">Detail</a>
                                            <a href="<?php echo site_url('admin/slider/update/id/' . $row->id); ?>" class="badge badge-warning">Update</a>
                                            <a href="<?php echo site_url('admin/slider/delete/id/' . $row->id); ?>" class="badge badge-important" title="Delete">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
</section>