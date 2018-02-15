<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">List Directory</h3>
            </div>
            <div class="modal-body">
                <?php foreach ($list_directory as $row) { ?>
                    <a href="#myModal<?php echo $row->id; ?>" role="button" class="btn" data-toggle="modal"><?php echo $row->name; ?></a>
                <?php } ?>
                    <a href="#myModal_all" role="button" class="btn" data-toggle="modal">All</a>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                
            </div>
        </div>
    </div>
</div>

<?php foreach ($list_directory as $dir) { ?>
    <div class="modal fade" id="myModal<?php echo $dir->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">List Image</h3>
                </div>
                <div class="modal-body">
                    <?php
                    foreach ($list_image as $row) {
                        if ($row->category == $dir->id) {
                            ?>
                            <a class="info" title ="Choose Image" href="#" onclick="send_data('<?php echo $row->path; ?>')">
                                <img src="<?php echo IMG_UPLOADED_THUMBS . $row->path; ?>" />
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<div class="modal fade" id="myModal_all" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">List Image</h3>
            </div>
            <div class="modal-body">
                <?php
                foreach ($list_image as $row) {
                    ?>
                    <a class="info" title ="Choose Image" href="#" onclick="send_data('<?php echo $row->path; ?>')">
                        <img src="<?php echo IMG_UPLOADED_THUMBS . $row->path; ?>" />
                    </a>
                    <?php
                }
                ?>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Save changes</button>
            </div>
        </div>
    </div>
</div>