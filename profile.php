<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/Tweeter_icon.png"/>
    <link rel="stylesheet" href="assets/style/profile_style.css">

</head>
<body>
<!-- Boris -->
<?php
include_once "header.html";
?>

<!-- Georgi -->
<div id="cover">
    <img src="" alt="">
</div>
<nav id="my_nav">
    <ul>
        <li><a href="#">Следва</a></li>
        <li><a href="#">Последователи</a></li>
        <li><a href="#">Списъци</a></li>
        <li><a href="#">Моменти</a></li>
    </ul>
    <button id="edit_btn">Редактиране на профила</button>
    <div id="profile_card">
        <div id="nav_image">

        </div>
        <a href="#">@Georgi</a>
    </div>

</nav>
<div id="circle">

</div>

<div id="height">

</div>
<script>
    var header = document.getElementById("my_nav");

    window.onscroll = function (event) {
        requestAnimationFrame(checkPos);
    };

    function checkPos() {
        var circle = document.getElementById('circle');
        var cover = document.getElementById("cover");
        var card = document.getElementById("profile_card");
        var y = window.scrollY;
        if (y >= 130) {
            circle.style.marginTop = "-200px";
            circle.style.transition = "margin-top 200ms linear";
            document.getElementById("nav_image").style.visibility = "visible";
            header.style.position = "fixed";
            cover.style.position = "fixed";
            header.style.top = "70px";
            cover.style.top = "-70px";
            card.style.opacity = "1";
        }
        else {
            card.style.opacity = "";
            cover.style.top = "";
            cover.style.position = "";
            header.style.position = "";
            circle.style.marginTop = "";
            circle.style.visibility = "";
            circle.style.top = "";
        }
    }

</script>
</body>
</html>
