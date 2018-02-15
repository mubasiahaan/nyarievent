(function () {

    var parallax = document.querySelectorAll(".parallax"),
            speed = 0.5;

    window.onscroll = function () {
        [].slice.call(parallax).forEach(function (el, i) {

            var windowYOffset = window.pageYOffset,
                    elBackgrounPos = "0 " + (windowYOffset * speed) + "px";

            el.style.backgroundPosition = elBackgrounPos;

        });
    };

})();


$('#myCarouselg').carousel({
    interval: 5000})

$('#myCarouselm').carousel({
    interval: 5000})

$('.carousel-blog .item').each(function () {
    var next = $(this).next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i = 0; i < 2; i++) {
        next = next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
    }
});