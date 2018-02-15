<div class="opent">
    <span class="cls"></span>
    <span>
        <ul class="sub-menus">
            <li><a href="<?= site_url('home'); ?>">Home</a></li>
            <li><a href="<?= site_url('event'); ?>">Category</a></li>
            <li><a href="<?= site_url('share_moment'); ?>">Share Moment</a></li>
            <li><a href="<?= site_url('faq'); ?>">FAQ's</a></li>
            <li><a href="<?= site_url('contact'); ?>">Contact Us</a></li>
        </ul>
    </span>
    <span class="cls"></span>
</div>

<script>
    $(document).ready(function () {
        $(document).delegate('.opent', 'click', function (event) {
            $(this).addClass('oppenned');
            event.stopPropagation();
        })
        $(document).delegate('body', 'click', function (event) {
            $('.opent').removeClass('oppenned');
        })
        $(document).delegate('.cls', 'click', function (event) {
            $('.opent').removeClass('oppenned');
            event.stopPropagation();
        });
    });
</script>