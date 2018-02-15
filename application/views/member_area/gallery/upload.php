<script type="text/javascript">
    $(function ($) {
        // Create variables (in this scope) to hold the API and image size
        var jcrop_api,
                boundx,
                boundy,
                // Grab some information about the preview pane
                $preview = $('#preview-pane'),
                $pcnt = $('#preview-pane .preview-container'),
                $pimg = $('#preview-pane .preview-container img'),
                xsize = 730,
                ysize = 486;


        $('#crop_image').Jcrop({
            onChange: updatePreview,
            onSelect: updatePreview,
            bgOpacity: 0.5,
            aspectRatio: xsize / ysize
        }, function () {
            // Use the API to get the real image size
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];

            jcrop_api = this; // Store the API in the jcrop_api variable

            // Move the preview into the jcrop container for css positioning
            $preview.appendTo(jcrop_api.ui.holder);
        });

        function updatePreview(c) {
            if (parseInt(c.w) > 0) {
                var rx = xsize / c.w;
                var ry = ysize / c.h;

                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);

                $pimg.css({
                    width: Math.round(rx * boundx) + 'px',
                    height: Math.round(ry * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });
            }
        }

    });
</script>
<style>

    #wrapper {
        width: 900px;
        margin: 0 auto;
    }

    #imagecrop {
        display: block;
        text-align: center;
        padding-bottom: 20px;
    }

    #form-container {
        display: block;
        position: absolute; 
        top: 300px; 
        right: 35px;
    }

    /* jcrop styles */
    .jc-demo-box {
        position: relative;
        text-align: left;
        margin: 1.5em auto;
        background: #fff;
        -webkit-box-shadow: 0 3px 9px -1px rgba(0,0,0,0.75);
        -moz-box-shadow: 0 3px 9px -1px rgba(0,0,0,0.75);
        box-shadow: 0 3px 9px -1px rgba(0,0,0,0.75);
        padding: 1em 2em 2em;
    }

</style>



<div class="panel-body">
    <?php
    if (isset($error_messages))
        echo $error_messages;
    ?>
    <?php if (isset($img_target)) { ?>
        <div class="editcontainer ">
            <?php echo $img_target; ?>
            <div id="form-container">
                <form id="cropimg" name="cropimg" method="post" action="<?php echo site_url('member_area/gallery/crop'); ?>">
                    <input type="hidden" name="filename" value="<?php echo $filename; ?>">
                    <input type="hidden" id="x" name="x">
                    <input type="hidden" id="y" name="y">
                    <input type="hidden" id="w" name="w">
                    <input type="hidden" id="h" name="h">
                    <input class="form-control btn btn-primary" type="submit" id="submit" value="Crop Image!">
                </form>
            </div><!-- @end #form-container -->
        </div>
        <?php
    } else {
        ?> <form class="form-horizontal jc-margin-right" role="form" method="post"
              action="<?php echo site_url('member_area/gallery/index'); ?>"
              enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-lg-1 control-label" for="focus">Upload Image</label>
                <div class="col-lg-4">
                    <input type="file" id="uploadimage" name="uploadimage" class="form-control" value="<?php echo set_value('txt_userid'); ?>" /> *Max Size
                    2MB, Dimension at fit (730 x 486) and File Type .jpg, .jpeg, .png
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-1 control-label" for="focus">Caption*</label>
                <div class="col-lg-4">
                    <input type="text" name="tx_caption" class="form-control" value="<?php echo set_value('tx_caption'); ?>" placeholder="Image Caption"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-1 control-label" for="focus">Category*</label>
                <div class="col-lg-4">
                    <?php echo form_dropdown("category", $category_id, set_value('category'), "class='form-control' id='category'"); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-1 control-label" for="focus"></label>
                <div class="col-lg-4">
                    <input type="submit" class="btn btn-info" name="upload" value="Upload" />
                </div>
            </div>
        </form>
    <?php } ?>
</div>
