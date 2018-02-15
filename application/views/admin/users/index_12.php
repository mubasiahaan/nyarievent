<section>
    <?php echo empty($info_messages) ? '' : $info_messages; ?>
    <?php foreach ($list_company as $row) { ?>
        <div class="col-lg-12">
            <div class="panel panel-<?php echo $row->theme; ?>">
                <div class="panel-heading">
                    <h4>
                        <span class="icon16 icomoon-icon-equalizer-2"></span>
                        <span><?php echo $row->name; ?></span>
                    </h4>
                </div>
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($list_product)) { ?>
                                    <tr class="odd gradeX">
                                        <td class="center"><i>(empty)</i></td>
                                        <td class="center"><i>(empty)</i></td>
                                        <td class="center"><i>(empty)</i></td>
                                        <td class="center"><i>(empty)</i></td>
                                        <td class="center"><i>(empty)</i></td>
                                    </tr>
                                <?php } else { ?>
                                    <?php foreach ($list_product as $rst) { ?>
                                        <tr class="odd gradeX">
                                            <td>Trident</td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                            <td class="center">X</td>
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
    <?php } ?>
</section>