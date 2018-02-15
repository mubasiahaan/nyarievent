
<div class="panel panel-blue">
    <div class="panel-heading">
        <h4>
            <span>List Message</span>
        </h4>
    </div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>message</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    <?php if (empty($list_data_message)) { ?>
                        <tr class="odd gradeX">
                            <td class="center"><i>(empty)</i></td>
                            <td class="center"><i>(empty)</i></td>
                            <td class="center"><i>(empty)</i></td>

                        </tr>
                    <?php } else { ?>
                        <?php foreach ($list_data_message as $row) { ?>
                            <tr class="odd gradeX">
                                <td><?php echo $row->id; ?></td>
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo $row->email; ?></td>
                                <td><?php echo $row->message; ?></td>
                                <td>
                                    <a href="<?php echo site_url('admin/messages/delete/id/' . $row->id); ?>" class="badge badge-important" title="Delete">Delete</a>
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