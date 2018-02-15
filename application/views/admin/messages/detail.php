<section>
    <div class="col-lg-12">
        <div class="panel panel-blue">
            <div class="panel-heading">
                <h4>
                    <span>Detail Article</span>
                </h4>
            </div>
            <div class="panel-body">
                
               <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Nama :</td>
                            <td><?php echo!empty($cont_update->name) ? $cont_update->name : ''; ?></td>
                        </tr>
                        <tr>
                            <td>Link :</td>
                            <td><?php echo!empty($cont_update->link) ? $cont_update->link : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Status :</td>
                            <td><?php echo!empty($cont_update->status) ? $cont_update->status : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Order :</td>
                            <td><?php echo!empty($cont_update->order) ? $cont_update->order : ""; ?></td>
                        </tr>
                        <tr>
                            <td>Nama File:</td>
                            <td><?php 
                                echo!empty($cont_update->file_name) ? $cont_update->file_name : ""; 
                                ?>
                        </tr>
                        <tr>
                            <td>Gambar:</td>
                            <td><img src="<?php 
                                echo !empty($cont_update->file_name) ? BASE_URL.'assets/uploads/images/slider/'.$cont_update->file_name : ""; 
                                ?>" alt="" class="img-responsive" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <a href="<?php echo site_url('admin/slider/' ); ?>" class="btn btn-primary">Kembali</a>
                            </td>
                                
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script>
    function send_data(main) {
        var value = main + ';';
        $('#image').val(value);
        $('#myModal').modal('hide');
    }
</script>
<script>
    // Tiny MCE
    tinymce.init({
        selector: "#txt_detail",
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
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });

</script>
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Modal header</h3>
    </div>
    <div class="modal-body">
        <?php foreach ($list_image as $row) { ?>
            <a class="info" title ="Choose Image" href="#" onclick="send_data('<?php echo $row->path; ?>')">
                <img src="<?php echo IMG_UPLOADED_THUMBS . $row->path; ?>" />
            </a>
        <?php } ?>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Save changes</button>
    </div>
</div>