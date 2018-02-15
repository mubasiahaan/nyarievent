<section>
    <div class="col-lg-12">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span class="icon16 icomoon-icon-equalizer-2"></span>
                    <span>List User</span>
                    <a href="<?php echo site_url('admin/users/add'); ?>" class="btn btn-xs btn-success" title="Add Users"><i class="fa fa-plus"></i>+ Add Users</a>
                </h4>
            </div>
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Role</th>
                                <th>Member Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php if (empty($list_users)) { ?>
                                <tr class="odd gradeX">
                                    <td class="center"><i>(empty)</i></td>
                                    <td class="center"><i>(empty)</i></td>
                                    <td class="center"><i>(empty)</i></td>
                                    <td class="center"><i>(empty)</i></td>
                                    <td class="center"><i>(empty)</i></td>
                                    <td class="center"><i>(empty)</i></td>
                                    <td class="center"><i>(empty)</i></td>

                                </tr>
                                <?php
                            } else {
                                $i = 1;
                                ?>
                                <?php foreach ($list_users as $row) { ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row->username; ?></td>
                                        <td><?php echo $row->name; ?></td>
                                        <td><?php echo $list_role[$row->role]; ?></td>
                                        <td><?= ($row->gold_expired >= date("Y-m-d")) ? "Gold" : "Regular"; ?></td>

                                        <td><?php
                                            if ($row->status == 1) {
                                                echo 'Active';
                                            } else if ($row->status == 2) {
                                                echo 'Non Active';
                                            } else {
                                                echo 'New Member';
                                            }
                                            ?></td>

                                        <td>
                                            <a href="<?php echo site_url('admin/users/detail/id/' . $row->id); ?>" class="badge badge-info">Detail</a>
                                            <a href="<?php echo site_url('admin/users/update/id/' . $row->id); ?>" class="badge badge-warning">Update</a>
                                            <a href="<?php echo site_url('admin/users/delete/id/' . $row->id); ?>" class="badge badge-important" title="Delete">Delete</a>
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


<script type="text/javascript">
    $(document).ready(function () {
        $('#tbl_items').dataTable();


    })
</script>
<script>
    $(document).ready(function () {

        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>
