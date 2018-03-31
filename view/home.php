<!--24.03.2017 Boris-->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/Tweeter_icon.png"/>
    <link rel="stylesheet" href="assets/style/home_style.css">

</head>
<body>
<?php
session_start();
include "header.html";
?>
<div class="home_wrap">
    <div id="home_left_div">
        <?php
        include "home_profile.html";
        ?>
    </div>
    <div id="home_mid_div">
        <?php
        include "compose_twat.html";
        include_once "ownTweets.html";
        ?>
    </div>
    <div id="home_right_div">
        <div id="random_users">
            <div id="who_to_follow">
                <h1>Кого да следваш</h1><a href="#" onclick="random()">.Oбновяване.</a>
            </div>
            <div id="randoms">

            </div>
        </div>
        <div id="position_div">
            <div id="small_cover">
                <img id="small_cover_image" src="" alt="">
            </div>
            <div id="small_profile_pic">
                <img id="small_image" src="" alt="">
            </div>

            <div id="small_name">
                <h1 id="small_h1"></h1>
                <h4 id="small_h4"></h4>
            </div>
            <div id="small_description">
                <h5 id="opisanie"></h5>
            </div>
            <div id="small_info">
                <div class="info">
                    <h1>Следва</h1>
                    <span id="one"></span>
                </div>
                <div class="info">
                    <h1>Последователи</h1>
                    <span id="two"></span>
                </div>
                <div class="info">
                    <h1>Туитове</h1>
                    <span id="three"></span>
                </div>

            </div>
        </div>
    </div>
</div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', random, false);

    //    window.onload = random();
    function random() {
        var request = new XMLHttpRequest();
        request.open("GET", "../controller/showRandomUsersController.php");
        request.onreadystatechange = function (ev) {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);

                var random_users_div = document.getElementById("random_users");
                var randoms = document.getElementById("randoms");
                randoms.style.width = "100%";
                randoms.style.height = "80%";
                randoms.innerHTML = "";

                for (var key in response) {
                    var user_div = document.createElement("div");
                    user_div.id = "first";
                    var image_div = document.createElement("div");
                    image_div.id = "random_img_div";
                    var img = document.createElement("img");
                    img.id = "random_img";
                    img.src = response[key]['user_pic'];
                    var name = document.createElement("h1");
                    name.id = "random_name";
                    var a = document.createElement("a");
                    a.href = "profile.php?" + response[key]["user_name"];
                    a.id = "a_name";
                    a.innerText = response[key]["user_name"];
                    a.addEventListener("mouseover", function () { /*При ховър се показва допълнителна информация за юзъра*/

                        var user_name = this.innerHTML;
                        var request = new XMLHttpRequest();
                        request.open("GET", "../controller/showProfileController.php?name=" + user_name);
                        request.onreadystatechange = function (ev) {
                            if (this.status == 200 && this.readyState == 4) {
                                var response = JSON.parse(this.responseText);

                                var cover = document.getElementById("small_cover_image");
                                cover.src = response[0]['user_cover'];
                                var image = document.getElementById("small_image");
                                image.src = response[0]['user_pic'];
                                var name = document.getElementById("small_h1");
                                name.innerText = response[0]['user_name'];
                                var small_name = document.getElementById("small_h4");
                                small_name.innerText = "@" + response[0]['user_name'];
                                var asd = document.getElementById("opisanie");
                                asd.innerHTML = response[0]['user_description'];
                            }
                        };
                        request.send();

                        var request2 = new XMLHttpRequest();
                        request2.open("GET", "../controller/showSmallDivTwits.php?name=" + user_name);
                        request2.onreadystatechange = function (ev) {
                            if (this.status == 200 && this.readyState == 4) {
                                var response = JSON.parse(this.responseText);

                                var first = document.getElementById("one");
                                var second = document.getElementById("two");
                                var third = document.getElementById("three");

                                first.innerHTML = response[0][0]['num'];
                                second.innerHTML = response[1][0]['num'];
                                third.innerHTML = response[2][0]['num'];
                            }
                        };
                        request2.send();

                        /*Определя се позицията на която да се покаже прозореца с допълнителната информация*/
                        var posx = 0;
                        var posy = 0;
                        if (!e) var e = window.event;
                        if (e.pageX || e.pageY) {
                            posx = e.pageX;
                            posy = e.pageY;
                        }
                        else if (e.clientX || e.clientY) {
                            posx = e.clientX;
                            posy = e.clientY;
                        }
                        var position = document.getElementById("position_div");
                        position.style.left = posx + "px";
                        position.style.top = posy + "px";
                        position.style.display = "block";
                        position.style.opacity = "1";
                        position.style.transition = "opacity 1.25s linear";

                    });
                    /*При махане на мишката прозореца се скрива*/
                    a.addEventListener("mouseout", function () {
                        var position = document.getElementById("position_div");
                        position.style.display = "none";
                    });

                    var button = document.createElement("button");
                    button.innerText = "Follow";
                    button.classList.add("follow_btn");
                    var find = document.createElement("div");
                    var h1 = document.createElement("h1");
                    find.id = "last_div";
                    h1.innerText = "Намери хора, които познаваш";
                    h1.addEventListener('click', function () {   /*При натискане фокуса се премества върху сърч полето*/
                        var search = document.getElementById("searchInput");
                        search.focus();
                    });
                    find.appendChild(h1);
                    randoms.appendChild(user_div);
                    user_div.appendChild(image_div);
                    image_div.appendChild(img);
                    name.appendChild(a);
                    user_div.appendChild(name);
                    user_div.appendChild(button);
                }
                randoms.appendChild(find);
            }
        };
        request.send();
    }
</script>
</html>
