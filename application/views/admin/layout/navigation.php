<div class="navigation">
    <ul class="breadcrumb hidden-xs">
        <li>You are here :</li>
        <li><span class="icon16 icomoon-icon-screen-2"></span></li>

        <?php
        foreach ($navigation as $key => $value) {
            if ($key == '#') {
                ?>
        <li><span class="divider"><span class="icon16 icomoon-icon-arrow-right-3"></span></span><?= strtolower($value) ; ?> </li>
                <?php
            } else {
                ?> 
                <li><span class="divider"><span class="icon16 icomoon-icon-arrow-right-3"></span></span><a href="<?= site_url($key) ?>"><?= strtolower($value); ?></a> </li>
                        <?php
                    }
                }
                ?>


    </ul>


</div>