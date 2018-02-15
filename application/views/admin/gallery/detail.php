<?php $this->load->view('admin/gallery/upload'); ?>
<section>
    <div class="col-lg-12">
        <div class="panel panel-blue2">
            <div class="panel-heading"><h4>List Images</h4></div>
            <div class="panel-body">
                <?php
                if (!empty($list_image)) {
                    foreach ($list_image as $row) {
                        $img = IMG_UPLOADED_THUMBS . $row->path;
                        ?>
                        <div class="col-lg-2">
                            <img src="<?php echo $img; ?>" class="image img-thumbnail" />
                            <a class="btn btn-default" style="position: absolute; top: 5px; left: 15px; opacity: 0.9" href="<?php echo site_url('admin/gallery/edit/' . $row->id); ?>"><span class="icomoon-icon-pencil"></span></a>
                            <a class="btn btn-default" style="position: absolute; top: 5px; right: 15px; opacity: 0.9" href="<?php echo site_url('admin/gallery/delete/' . $row->id); ?>"><span class="icomoon-icon-remove"></span></a>
                        </div>
                        <?php
                    }
                } else {
                    echo 'Tidak Ada Gambar!';
                }
                ?>
            </div>
        </div>
    </div>
</section>