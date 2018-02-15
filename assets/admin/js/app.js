var $h = document.getElementById("hide"),
        $h2 = document.getElementById("hide2"),
        $s = document.getElementById("sidebarbg"),
        $n = $s.getElementsByClassName('nav-text'),
        $m = document.getElementById("main"), i, m,
        $mwidth = $m.offsetWidth, count,
        $sOver = $s.getElementsByClassName("s"),
        $siconOver = $s.getElementsByClassName("sicon");

$h2.style.display = 'none';
$h.onclick = hideFunction;
function hideFunction() {
    $s.style.width = '60px';
    $m.className = 'col-sm-12';
    $h2.style.display = 'inline';
    $h.style.display = 'none';
    $m.style["padding-left"] = '60px';
    $m.style["margin-left"] = '0';
    for (m = 0; m < $siconOver.length; m++) {
        $siconOver[m].style.borderRight = '1px solid #bbb';
    }
    for (i = 0; i < $n.length; i++) {
        $n[i].style.display = "none";
        $n[i].style.opacity = 0;
    }
    count = 0;
}
$h2.onclick = visibleFunction;
function visibleFunction() {
    $s.style.width = '16.6667%';
    $m.className = 'col-sm-10 col-sm-offset-2';
    $h2.style.display = 'none';
    $h.style.display = 'inline';
    $m.style["padding-left"] = '0';
    $m.style["margin-left"] = '16.6667%';
    for (m = 0; m < $siconOver.length; m++) {
        $siconOver[m].style.borderRight = 'none';
    }
    var waktw = setInterval(function () {
        count++;
        if (count === 2) {
            for (i = 1; i < $n.length; i++) {
                $n[i].style.display = "inline";
            }
        } else if (count > 3) {
            for (i = 1; i < $n.length; i++) {
                $n[i].style.opacity = 1;
            }
            $n[0].style.display = 'inline';
            $n[0].style.opacity = 1;
            clearInterval(waktw);
            waktw = 0;
        }
    }, 100);
}
var s=[];
s[0]=function(){$sOver[0].id = "sicon";};
s[1]=function(){$sOver[1].id = "sicon";};
s[2]=function(){$sOver[2].id = "sicon";};
s[3]=function(){$sOver[3].id = "sicon";};
s[4]=function(){$sOver[4].id = "sicon";};
s[5]=function(){$sOver[5].id = "sicon";};
s[6]=function(){$sOver[6].id = "sicon";};
s[7]=function(){$sOver[7].id = "sicon";};
s[8]=function(){$sOver[8].id = "sicon";};
s[9]=function(){$sOver[9].id = "sicon";};
s[10]=function(){$sOver[10].id = "sicon";};
s[11]=function(){$sOver[11].id = "sicon";};
s[12]=function(){$sOver[12].id = "sicon";};
var liNavX = function () {
    for (var t = 0; t < $sOver.length; t++) {
        $sOver[t].id = "";
    }
};
for (var t = 0; t < $sOver.length; t++) {
    $sOver[t].addEventListener("mouseover", s[t], false);
    $sOver[t].addEventListener("mouseout", liNavX, false);
}
