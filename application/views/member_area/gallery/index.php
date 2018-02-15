
<section>
    
    <div class="col-lg-10">
        <div class="panel panel-blue2">
            <div class="panel-heading"><h4>List Directory</h4></div>
            
            <?php $this->load->view('member_area/gallery/upload'); ?>
            
            <div class="panel-body">
                <?php
                if (!empty($category_id)) {

                    foreach ($category_id as $key => $value) {
                        ?>
                        <div class="col-lg-2" style="margin-bottom: 10px">
                            <a class="btn btn-primary" href="<?php echo site_url('/member_area/gallery/detail/' . $key); ?>" > <?php echo $value; ?></a>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="col-lg-2" style="margin-bottom: 10px">
                        <a class="btn btn-primary" href="<?php echo site_url('/member_area/gallery/detail/all'); ?>" > All</a>
                    </div>
                    <?php
                } else {
                    echo 'Tidak Ada Gambar!';
                }
                ?>
            </div>
        </div>
    </div>
</section>