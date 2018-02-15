
<?php $this->load->view('layout/menu'); ?>

<div class="logos" role="navigation">
    <div class="containerrr">
        <div class="pull-left">
            <p class="call hidden-xs">Call us : <span><?= $web_info['phone'] ?></span></p>
            <?php if ($this->session->userdata('sess-id')) { ?>   
                <p class="msg"><a href="<?= site_url('member_area/home/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> Logout </a></p>
            <?php } else { ?>
                <p class="msg"><a href="<?= site_url('login') ?>"><i class="glyphicon glyphicon-log-in"></i> Login </a></p>
            <?php } ?>
        </div>
    </div>
</div>
<a class="navbar-brand topBar-info" href="<?= site_url() ?>">
    <img src="<?= ASSETS_PATH; ?>img/nyarievent-logo.png" alt="" />
</a>
<div id="carousel-top" class="carousel slide" data-ride="carousel">
    <!--<ol class="carousel-indicators">
        <li data-target="#carousel-top" data-slide-to="0" class="active"></li>
    </ol>-->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <section class="module parallax" style="background-image: url('<?= ASSETS_PATH; ?>img/bg0.jpg')"></section>
        </div>
    </div>
    <div class="carousel-caption">
        <h2>Better <span>starts</span> here</h2>
        <p>What are you waiting for? Make your event famous here.</p>
    </div>
</div>
<script>
    $(window).scroll(function (event) {

        var yOffset = window.pageYOffset;
        var breakpoint = 50;
        if (yOffset > breakpoint) {
            $("nav").addClass('active');
        } else {
            $("nav").removeClass('active');
        }
    });

    $(window).resize(function () {
        $('.parallax').css('height', $(window).height() * 1);
    });

    $(function () {
        $(window).resize()
    });
</script>

