(function () {
    var imgDell = document.getElementById("imgDel").getElementsByTagName("img"),
            srcEmbed = document.getElementById("myplayer"), ex = 0,
            vidYou = document.getElementById("vidYou");
            videoo = document.getElementById("videoo").getElementsByTagName("span");
    function cupa() {
        for (g = 0, len = videoo.length; g < len; g++) {
            imgDell[g].style.opacity = 0;
            srcEmbed.src = "";
        };
    }
    cupa();
    imgDell[0].style.opacity = 1;
    function cupaT(x) {
        imgDell[x].style.opacity = 1;
    }
    var imgDellbtn = document.getElementById("imgDellbtn");
    imgDellbtn.onclick = function () {
        for (g = 0, len = videoo.length; g < len; g++) {
            imgDell[g].style.opacity = 0;
            imgDell[g].style.position = 'absolute'; // added for single cideo
        };
        vidYou.style.position = 'relative';
        imgDellbtn.style.opacity = 0;
        srcEmbed.src = "http://www.youtube.com/embed/" + videoo[ex].innerHTML + "?autoplay=1&rel=0";
    };
    var btnDell = document.getElementById("chence").getElementsByTagName("a");
    for (var g = 0, len = videoo.length; g < len; g = g + 1) {
        btnDell[g].addEventListener('click', function () {
            cupa();
            vidYou.style.position = 'absolute';
            cupaT(this.id);
            ex = this.id;
            imgDellbtn.style.opacity = 1;
        });
    }
}());