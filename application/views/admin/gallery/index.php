<?php $this->load->view('admin/gallery/upload'); ?>
<section>
    <div class="col-lg-12">
        <div class="panel panel-blue">
            <div class="panel-heading"><h4><span>List Directory</span></h4></div>
            <div class="panel-body">
                <?php
                if (!empty($category_id)) {

                    foreach ($category_id as $key => $value) {
                        ?>
                        <div class="col-md-2" style="margin-bottom: 10px">
                            <a class="btn btn-link lw" href="<?php echo site_url('/admin/gallery/detail/' . $key); ?>" > 
								<img src="<?= base_url('assets'); ?>/admin/images/folderr.png" alt="" /><br/>
							<?php echo $value; ?></a>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="col-md-2" style="margin-bottom: 10px">
                        <a class="btn btn-link" href="<?php echo site_url('/admin/gallery/detail/all'); ?>" > 
						<img src="<?= base_url('assets'); ?>/admin/images/folderr.png" alt="" /><br/> All</a>
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