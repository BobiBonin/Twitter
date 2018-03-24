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
include_once 'page_lock.php';
include_once "header.html";
?>

<!-- Georgi -->
<div id="cover">
    <img id="cover_img" src="" alt="">
</div>
<nav id="my_nav">
    <ul>
        <li><a href="#">Следва</a></li>
        <li><a href="#">Последователи</a></li>
        <li><a href="#">Списъци</a></li>
        <li><a href="#">Моменти</a></li>
    </ul>
    <div id="profile_card">
        <div id="nav_image">
            <img src="" id="nav_img">
        </div>
        <a id="nav_name" href="#">@Georgi</a>
    </div>
</nav>
<div id="circle">
    <img id="circle_img" src="">
</div>


<div id="profile_edit">
    <form method="post" action="../controller/editProfileControler.php" enctype="multipart/form-data">
        <input type="text" name="username" id="username">
        <input type="email" name="email" id="email">
        <input type="password" name="password" placeholder="Enter password">
        <input type="password" name="rpassword" placeholder="Repeat password">
        <input type="file" name="user_pic" class="file" value="Profile picture">
        <input type="file" name="user_cover" class="file">
        <input type="submit" value="Edit" id="btn_edit" name="btn_edit">
    </form>
</div>
<div id="height">
</div>
<script>
    /*Georgi -- 20.03.2018 -- Скриване и показване на профилната снимка в навигейшън бара*/
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

    /*Georgi -- 23.03.2018 --  Запълване на профилите в зависимост дали търсим някой или разглеждаме своя собствен*/
    var queryString = decodeURIComponent(window.location.search);
    queryString = queryString.substring(1);
    var queries = queryString.split("&");

    if (queryString.length != 0) { /*Ако в URL има параметър(чужд профил)*/
        var request = new XMLHttpRequest();
        request.open("GET", "../controller/showProfileController.php?name=" + queries[0]);
        request.onreadystatechange = function (ev) {
            if (this.status == 200 && this.readyState == 4) {
                var response = JSON.parse(this.responseText);
                var img = document.getElementById("circle_img");
                var small_img = document.getElementById("nav_img");
                var a = document.getElementById("nav_name");
                var profile_icon = document.getElementById("profile_icon");
                var button = document.createElement("button");
                var cover = document.getElementById("cover_img");
                button.innerText = "Последване";
                button.id = "edit_btn";
                button.name = "follow";
                document.getElementById("my_nav").appendChild(button);
                profile_icon.src = response[0]['user_pic'];
                a.innerText = '@' + response[0]['user_name'];
                a.href = "profile.php?" + response[0]['user_name'];
                img.src = "";
                img.src = response[0]['user_pic'];
                small_img.src = response[0]['user_pic'];
            }
        };
        request.send();
    } else { /*Ако в URL няма параметър(моя профил)*/
        var request = new XMLHttpRequest();
        request.open("GET", "../controller/profileController.php");
        request.onreadystatechange = function (ev) {
            if (this.status == 200 && this.readyState == 4) {
                var response = JSON.parse(this.responseText);
                var img = document.getElementById("circle_img");
                var small_img = document.getElementById("nav_img");
                var a = document.getElementById("nav_name");
                var button = document.createElement("button");
                var cover = document.getElementById("cover_img");
                document.getElementById("my_nav").appendChild(button);
                button.innerText = "Редактиране на профила";
                button.id = "edit_btn";
                button.name = "edit_btn";
                button.addEventListener("click", function () {
                    var edit_div = document.getElementById("profile_edit");
                    edit_div.style.visibility = "visible";
                    edit_div.style.zIndex = "1000";
                    var request = new XMLHttpRequest();
                    request.open("GET", "../controller/profileController.php");
                    request.onreadystatechange = function (ev2) {
                        if (this.readyState == 4 && this.status == 200) {
                            var result = JSON.parse(this.responseText);
                            var username = document.getElementById("username");
                            var email = document.getElementById("email");
                            var btn = document.getElementById("btn_edit");
                            username.value = result['user_name'];
                            email.value = result['user_email'];
                        }
                    };
                    request.send();
                });
                a.innerText = '@' + response['user_name'];
                a.href = "profile.php?" + response['user_name'];
                img.src = "";
                img.src = response['user_pic'];
                small_img.src = response['user_pic'];
                cover.src = response['user_cover'];
            }
        };
        request.send();
    }
</script>
</body>
</html>
