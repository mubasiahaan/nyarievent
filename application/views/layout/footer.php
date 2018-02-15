<footer>
    <div class="container">
        <section>
            <div class="col-md-6">
                <ul class="list-inline">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">Connect</a></li>
                </ul>
            </div>
            <div class="col-md-6 text-right">
                <h3>&COPY; Nyari Event - 2017</h3>
            </div>
        </section>
    </div>
</footer>
<script>
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
</script>