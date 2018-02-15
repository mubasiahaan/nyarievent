
<div class="col-lg-10 col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <span class="icon16 icomoon-icon-equalizer-2"></span>
                <span><?php echo $active_menu; ?></span>
            </h4>
        </div>
        <div class="panel-body">

            <div class="dataTable_wrapper">
                <form class="form-horizontal" action="<?php echo site_url('ticket_detail/' . $controler . '/update/' . $rec_data->id); ?>" method="post" role="form">
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Subject</label>
                        <div class="col-lg-9">
                            <?php echo $rec_data->subject; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">User</label>
                        <div class="col-lg-9">
                            <?php echo $rec_data->name; ?>  
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Status</label>
                        <div class="col-lg-9">
                            <?php echo $list_status[$rec_data->status]; ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-2 control-label" for="focus">Respond Status</label>
                        <div class="col-lg-9">
                            <?php echo ($rec_data->respon_status == 1) ? "Waiting Client response" : "Waiting Admin Response"; ?> 
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
                                <td><?php echo $rst->name; ?></td>

                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
            <div class="col-lg-12">
                <div class="panel panel-blue">
                    <div class="panel-heading">
                        <h4>
                            <span>Add <?php echo $active_menu; ?></span>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <?php echo empty($form_validation_errors) ? '' : $form_validation_errors; ?>
                        <form class="form-horizontal" action="<?php echo site_url('member_area/' . $controler . '/add/' . $rec_data->id); ?>" method="post" role="form">

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="focus">Response</label>
                                <div class="col-lg-9">
                                    <textarea name="txt_detail" id="txt_detail" class="txt_detail form-control" placeholder="Input your Response Detail"><?php echo set_value('txt_detail'); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <input type="submit" name="submit" value="Save Change" class="btn btn-info" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Tiny MCE
    tinymce.init({
        selector: ".txt_detail",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', event: 'Test 1'},
            {title: 'Test template 2', event: 'Test 2'}
        ]
    });

</script>
