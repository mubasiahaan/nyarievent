<header>    
    <div id="mobile-nav">
        <h2><?= $app_name; ?></h2>
    </div>
    <?php $this->load->view('admin/layout/side_menu'); ?>
    <?php $this->load->view('admin/layout/top_menu'); ?>
</header>

<script>
    $('#mobile-nav').click(function (event) {
        $('nav').toggleClass('active');
        $('#body').toggleClass('active');
    });
</script>