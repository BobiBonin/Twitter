<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/Tweeter_icon.png"/>
    <link rel="stylesheet" href="assets/style/profile_style.css">

</head>
<body on>
<!-- Boris -->
<?php
include_once 'page_lock.php';
include_once "header.html";
?>

<!-- Georgi -->
<div id="cover" onclick="hide()">
    <img id="cover_img" src="" alt="">
</div>
<nav id="my_nav">
    <div class="in_my_nav" id="first_in_my_nav">
        <ul>
            <li><a href="#" id="following" onclick="showFollowing()">Следва</a></li>
            <li><a href="#" id="followers">Последователи</a></li>
            <li><a href="#" id="twits">Туитове</a></li>
        </ul>
        <div id="profile_card">
            <div id="nav_image">
                <img src="" id="nav_img">
            </div>
            <a id="nav_name" href="#">@Georgi</a>
        </div>
</nav>
    </div>
<div class="in_my_nav">
    <div id="circle">
        <img id="circle_img" src="">
    </div>
</div>
<div id="profile_edit">
    <form method="post" action="../controller/editProfileControler.php" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Име:</td>
            <td><input type="text" name="username" id="username"></td>
        </tr>
        <tr>
            <td>Имейл:</td>
            <td><input type="email" name="email" id="email"></td>
        </tr>
        <tr>
            <td>Град:</td>
            <td><input type="text" name="city" id="city" placeholder="Град"></td>
        </tr>
        <tr>
            <td>Описание:</td>
            <td><textarea rows="5" cols="26" name="description" id="description" placeholder="Кратко описание.."></textarea></td>
        </tr>
        <tr>
            <td>Парола:</td>
            <td><input type="password" name="password" id="password" placeholder="Въведете парола"></td>
        </tr>
        <tr>
            <td>Профилна снимка:</td>
            <td><input type="file" name="user_pic" class="file" value="Profile picture"></td>
        </tr>
        <tr>
            <td>Снимка за корица:</td>
            <td><input type="file" name="user_cover" class="file"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Edit" id="btn_edit" name="btn_edit"></td>
        </tr>
    </table>
    </form>
</div>

<div id="main" onclick="hide()">
    <div id="user_info">

    </div>

    <div id="center_tweet">

    </div>

    <div id="random_users">
        <div id="first">

        </div>
        <div id="second">

        </div>
        <div id="third">

        </div>
        <div id="fourth">

        </div>
        <div id="fifth">

        </div>
    </div>
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
        var top_bar = document.getElementById("top_bar");
        var main = document.getElementById("main");
        var y = window.scrollY;
        if (y >= 330) {
            circle.style.marginTop = "-200px";
            circle.style.transition = "margin-top 200ms linear";
            document.getElementById("nav_image").style.visibility = "visible";
            header.style.position = "fixed";
            cover.style.position = "fixed";
            header.style.top = "70px";
            cover.style.top = "-330px";
            card.style.opacity = "1";
            main.style.marginTop = "484px";
            top_bar.style.top = "0";
        }
        else {
            document.getElementById("nav_image").style.visibility = "hidden";
            main.style.marginTop = "10px";
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
                document.getElementById("first_in_my_nav").appendChild(button);
                profile_icon.src = response[0]['user_pic'];
                a.innerText = '@' + response[0]['user_name'];
                a.href = "profile.php?" + response[0]['user_name'];
                img.src = "";
                img.src = response[0]['user_pic'];
                small_img.src = response[0]['user_pic'];
                cover.src = response[0]["user_cover"];
            }
        };
        request.send();
        /* Втори рекуест за  /СЛЕДВА,ПОСЛЕДОВАТЕЛИ,ТУИТОВЕ/ по профилите*/
        var request2 = new XMLHttpRequest();
        request2.open("GET", "../controller/followingControler.php?name=" + queries[0]);
        request2.onreadystatechange = function (ev) {
            if (this.status == 200 && this.readyState == 4) {
                var response = JSON.parse(this.responseText);
                console.log(response);
                var a = document.getElementById("following");
                var span = document.createElement('span');
                span.innerText = response[0][0]['num'];
                a.appendChild(span);

                var a = document.getElementById("followers");
                var span = document.createElement('span');
                span.innerText = response[1][0]['num'];
                a.appendChild(span);

                var a = document.getElementById("twits");
                var span = document.createElement('span');
                span.innerText = response[2][0]['num'];
                a.appendChild(span);
            }
        };
        request2.send();
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
                document.getElementById("first_in_my_nav").appendChild(button);
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
                            var city = document.getElementById("city");
                            var description = document.getElementById("description");
                            var password = document.getElementById("password");
                            var btn = document.getElementById("btn_edit");
                            btn.addEventListener("click", function () {
                               if(password.value == 0){
                                   password.style.border = "1px solid red";
                                   event.preventDefault();
                               }
                            });
                            username.value = result['user_name'];
                            email.value = result['user_email'];
                            city.value = result['user_city'];
                            description.value = result['user_description'];
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


        function showFollowing() {
            var request = new XMLHttpRequest();
            request.open("GET","../controller/showFollowing.php");
            request.onreadystatechange = function (ev) {
                if(this.readyState == 4 && this.status == 200){
                    var response = JSON.parse(this.responseText);
                    var center = document.getElementById("center_tweet");
                    center.style.width = "869px";
                    var right = document.getElementById("random_users");
                    right.style.visibility = "hidden";
                    right.style.width = "1px";
                    center.innerHTML ="";
                    for(var key in response){
                        var div = document.createElement("div");
                        div.classList.add("followingUserInfo");
                        var cover_div = document.createElement("div");
                        cover_div.classList.add("followingUserInfo_cover");
                        var img = document.createElement("img");
                        img.id = "followingUserInfo_image";
                        img.src = response[key]['user_cover'];

                        center.appendChild(div);
                        div.appendChild(cover_div);
                        cover_div.appendChild(img);

                        var div_name = document.createElement("div");
                        div_name.classList.add("followingUserDiv_name");
                        var user_img = document.createElement("img");
                        user_img.id = "followingUserProfile_image";
                        user_img.src = response[key]["user_pic"];
                        var h2 = document.createElement("h2");
                        h2.id = "profile_h2";
                        h2.innerText = response[key]["user_name"];
                        var h4 = document.createElement("h4");
                        h4.id = "profile_h4";
                        h4.innerText = "@" + response[key]["user_name"];

                        // var button = document.createElement("button");
                        // button.id = "btn_unfollow";
                        // div.appendChild(button);

                        div.appendChild(div_name);
                        div_name.appendChild(user_img);
                        div_name.appendChild(h2);
                        div_name.appendChild(h4);

                    }
                }
            };
            request.send();
        }
    }




</script>
</body>
</html>
