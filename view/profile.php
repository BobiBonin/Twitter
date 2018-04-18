<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/Tweeter_icon.png"/>
    <link rel="stylesheet" href="assets/style/profile_style.css">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
<!-- Boris -->
<?php
    include_once "page_lock.php";
    include_once "header.html";
?>

<!-- Georgi -->
<div id="cover">
    <img id="cover_img" src="" alt="">
</div>
<nav id="my_nav">
    <div class="in_my_nav" id="first_in_my_nav">
        <ul>
            <li><a href="#" id="following" onclick="showFollowing()">Следва<span id="sledva"></span></a></li>
            <li><a href="#" id="followers" onclick="showFollowers()">Последователи<span id="sledvat"></span></a></li>
            <li><a href="#" id="twits" onclick="showTwits()">Туитове<span id="tuitove"></span></a></li>
        </ul>
        <div id="profile_card">
            <div id="nav_image">
                <img src="" id="nav_img">
            </div>
            <a id="nav_name" href="#">@Georgi</a>
        </div>
</nav>
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
                <td><textarea rows="5" cols="26" name="description" id="description"
                              placeholder="Кратко описание.."></textarea></td>
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
<div id="main">
    <div id="user_info">
        <h1 id="name"><a></a></h1>
        <h2 id="name_"><a></a></h2>
        <p id="descriptionid"></p>
        <div id="cityid">
            <i class="fa fa-map-marker" aria-hidden="true"></i>

        </div>
        <div id="reg_date">
            <i class="fa fa-calendar" aria-hidden="true"></i>

        </div>
        <div id="emailid">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>

        </div>
    </div>

    <div id="center_tweet">

    </div>

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
<script>
    window.onload = random();
    /*Георги -- 20.03.2018 -- Скриване и показване на профилната снимка в навигейшън бара*/
    var header = document.getElementById("my_nav");
    window.onscroll = function (event) {
        requestAnimationFrame(checkPos);
    };

    function checkPos() {                                                /*Проверява позицията на скрола*/
        var circle = document.getElementById('circle');
        var cover = document.getElementById("cover");
        var card = document.getElementById("profile_card");
        var top_bar = document.getElementById("top_bar");
        var main = document.getElementById("main");
        var y = window.scrollY;
        if (y >= 330) {                                                 /*Ако е над 300px скрива снимката*/
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
        else {                                                /*В противен случай и връща параметрите по подразбиране*/
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

    /*Георги -- 23.03.2018 --  Запълване на профилите в зависимост дали търсим някой или разглеждаме своя собствен*/
    var queryString = decodeURIComponent(window.location.search);
    queryString = queryString.substring(1);
    var queries = queryString.split("&");
    /*---------------------------------------------------------------------------------------------------*/
    if (queryString.length != 0) { /*Георги --27.03.2018-- Ако в URL има параметър се запълва чужд профил*/
        var request = new XMLHttpRequest();
        request.open("GET", "../controller/showProfileController.php?name=" + queries[0]);
        request.onreadystatechange = function (ev) {
            if (this.status == 200 && this.readyState == 4) {
                var response = JSON.parse(this.responseText);

                var img = document.getElementById("circle_img");
                var small_img = document.getElementById("nav_img");
                var a = document.getElementById("nav_name");
                var button = document.createElement("button");
                var cover = document.getElementById("cover_img");
                var name = document.getElementById("name");
                var name_ = document.getElementById("name_");
                var description = document.getElementById("descriptionid");
                var city = document.getElementById('cityid');
                var reg_date = document.getElementById("reg_date");
                var email = document.getElementById("emailid");
                name.innerText = response[0]['user_name'];
                name_.innerText = "@" + response[0]['user_name'];
                description.innerHTML = response[0]['user_description'];
                city.innerText += 'Живее в: ' + response[0]['user_city'];
                reg_date.innerText = 'Регистриран на: ' + response[0]['user_date'].substring(0, 10);
                email.innerText = 'Имейл: ' + response[0]['user_email'];
                /*Проверка какъв бутон да бъде поставен*/
                var is_follow = new XMLHttpRequest();
                is_follow.open("GET", "../controller/isFollowController.php?name=" + queries[0]);
                is_follow.onreadystatechange = function (ev2) {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        if (response == "0") {
                            button.innerText = "Последване";
                            button.id = "edit_btn";
                            button.name = "follow";
                        } else {
                            button.innerText = "Премахни";
                            button.id = "edit_btn_remove";
                            button.name = "follow";
                        }
                    }
                };
                is_follow.send();
                /*В зависимост какъв е бутона се изпълнява LIKE или DISLIKE функция*/
                button.addEventListener("click", function () {
                    if (this.innerHTML == "Последване") {
                        var request = new XMLHttpRequest();
                        request.open("GET", "../controller/likeItController.php?name=" + queries[0]);
                        request.onreadystatechange = function (ev) {
                            if (this.readyState == 4 && this.status == 200) {
                                var response = JSON.parse(this.responseText);
                                if (response == "1") {
                                    button.innerText = "Премахни";
                                    button.id = "edit_btn_remove";
                                    showNumbers();
                                }
                            }
                        };
                        request.send();
                    } else if (this.innerHTML == "Премахни") {
                        var request = new XMLHttpRequest();
                        request.open("GET", "../controller/dislikeItController.php?name=" + queries[0]);
                        request.onreadystatechange = function (ev) {
                            if (this.readyState == 4 && this.status == 200) {
                                var response = JSON.parse(this.responseText);
                                if (response == "1") {
                                    button.innerText = "Последване";
                                    button.id = "edit_btn";
                                    showNumbers();
                                }
                            }
                        };
                        request.send();
                    }
                });
                document.getElementById("first_in_my_nav").appendChild(button);
                a.innerText = '@' + response[0]['user_name'];
                a.href = "profile.php?" + response[0]['user_name'];
                img.src = "";
                img.src = response[0]['user_pic'];
                small_img.src = response[0]['user_pic'];
                cover.src = response[0]["user_cover"];
            }
        };
        request.send();

        /* Георги --27.03.2018--  Втори рекуест (чужд профил) за визуализиране на цифрите на броя юзъри които
        * следва, го следват и публикуваните туитове*/
        function showNumbers() {
            var request2 = new XMLHttpRequest();
            request2.open("GET", "../controller/followingControler.php?name=" + queries[0]);
            request2.onreadystatechange = function (ev) {
                if (this.status == 200 && this.readyState == 4) {
                    var response = JSON.parse(this.responseText);

                    var a = document.getElementById("following");
                    var span = document.getElementById('sledva');
                    span.innerText = response[0][0]['num'];

                    var a = document.getElementById("followers");
                    var span = document.getElementById('sledvat');
                    span.innerText = response[1][0]['num'];

                    var a = document.getElementById("twits");
                    var span = document.getElementById('tuitove');
                    span.innerText = response[2][0]['num'];

                }
            };
            request2.send();
        }

        showNumbers();

        /*Георги --27.03.2018--С натискане върху линка "следва" се визуализират прозорци с информация
         * за всеки го следващ юзър */
        function showFollowing() {
            var request = new XMLHttpRequest();
            request.open("GET", "../controller/showOtherUserFollowing.php?name=" + queries[0]);
            request.onreadystatechange = function (ev) {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);

                    var center = document.getElementById("center_tweet");
                    center.style.width = "869px";
                    center.style.backgroundColor = "transparent";
                    var right = document.getElementById("random_users");
                    right.style.visibility = "hidden";
                    right.style.width = "1px";
                    center.innerHTML = "";
                    for (var key in response) {
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
                        var a = document.createElement("a");
                        a.id = "profile_h4";
                        a.innerText = "@" + response[key]["user_name"];
                        a.href = "profile.php?" + response[key]["user_name"];

                        div.appendChild(div_name);
                        div_name.appendChild(user_img);
                        div_name.appendChild(h2);
                        div_name.appendChild(a);
                    }
                }
            };
            request.send();
        }

        /*Георги --27.03.2018--С натискане върху линка "последователи" се визуализират прозорци с информация
         * за всеки последовател*/
        function showFollowers() {
            var request = new XMLHttpRequest();
            request.open("GET", "../controller/showFollowersController.php?name=" + queries[0]);
            request.onreadystatechange = function (ev) {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);

                    var center = document.getElementById("center_tweet");
                    center.style.width = "869px";
                    var right = document.getElementById("random_users");
                    right.style.visibility = "hidden";
                    right.style.width = "1px";
                    center.innerHTML = "";
                    for (var key in response) {
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
                        var a = document.createElement("a");
                        a.id = "profile_h4";
                        a.innerText = "@" + response[key]["user_name"];
                        a.href = "profile.php?" + response[key]["user_name"];

                        div.appendChild(div_name);
                        div_name.appendChild(user_img);
                        div_name.appendChild(h2);
                        div_name.appendChild(a);
                    }
                }
            };
            request.send();
        }

        /*Георги --27.03.2018--С натискане върху линка "туитове" се визуализират прозорец с всички туитове на потребителя*/
        function showTwits() {
            var center = document.getElementById("center_tweet");
            center.style.width = "600px";
            center.innerHTML = "";
            center.style.backgroundColor = "";

            var right = document.getElementById("random_users");
            right.style.visibility = "visible";
            right.style.width = "280px";
            showOtherUsersTwits(queries[0]);
        }

        function showOtherUsersTwits(name) {
            var request = new XMLHttpRequest();
            request.open("GET", "../controller/showOtherUsersTweetsController.php?name=" + name);
            request.onreadystatechange = function (ev) {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    var center_div = document.getElementById("center_tweet");
                    center_div.innerHTML = "";
                    for (var key in response) {
                        var tweet = document.createElement("div");
                        tweet.classList.add("tweet");
                        var image_div = document.createElement("div");
                        image_div.classList.add("tweet_image_div");
                        var img = document.createElement("img");
                        img.id = "tweet_image";
                        img.src = response[key]['user_pic'];
                        var tweet_content = document.createElement("tweet_content_div");
                        tweet_content.classList.add("content_div");
                        var name = document.createElement("h1");
                        name.classList.add("tweet_name");
                        name.innerText = response[key]['user_name'];
                        var date = document.createElement("h4");
                        date.classList.add("tweet_date");
                        date.innerText = response[key]['twat_date'];
                        var p = document.createElement("p");
                        p.classList.add("content");
                        p.innerText = response[key]['twat_content'];
                        var a = document.createElement("a");
                        a.innerText = "коментари";
                        a.classList.add("comments");

                        var comments_div = document.createElement("div");
                        comments_div.classList.add("comment_space");
                        comments_div.id = response[key]['twat_id'];
                        var text = document.createElement("input");
                        text.type = "text";
                        text.classList.add("comment_text");
                        text.name = response[key]['twat_id'];
                        text.id = "asd" + response[key]['twat_id'];
                        var button = document.createElement("button");
                        button.classList.add("comment_button");
                        button.innerText = "Изпрати";
                        button.value = response[key]['twat_id'];

                        button.addEventListener("click" , function () {
                            var request = new XMLHttpRequest();
                            request.open("post", "../controller/sendCommentController.php");
                            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            request.onreadystatechange = function (ev) {
                                if(this.readyState == 4 && this.status == 200){
                                    var response = JSON.parse(this.responseText);
                                    if(response == "1"){
                                        var queryString = decodeURIComponent(window.location.search);
                                        queryString = queryString.substring(1);
                                        var queries = queryString.split("&");
                                        showOtherUsersTwits(queries[0]);
                                    }
                                }
                            };
                            request.send("content=" + document.getElementById("asd"+ this.value).value + "&tweetId=" + this.value);

                        });

                        var tweet_id = response[key]['twat_id'];

                        image_div.appendChild(img);
                        tweet.appendChild(image_div);
                        tweet_content.appendChild(name);
                        tweet_content.appendChild(date);
                        tweet_content.appendChild(p);
                        tweet.appendChild(tweet_content);
                        tweet.appendChild(a);
                        center_div.appendChild(tweet);
                        center_div.appendChild(comments_div);
                        comments_div.appendChild(text);
                        comments_div.appendChild(button);

                        /*Георги 01.04.2018 -- Показва коментарите под туитовете !!!*/
                        var request = new XMLHttpRequest();
                        request.open("GET", "../controller/showMyTweetCommentController.php?tweet_id=" + tweet_id);
                        request.onreadystatechange = function (ev) {
                            if (this.readyState == 4 && this.status == 200) {
                                var response = JSON.parse(this.responseText);
                                var master_comment = document.createElement("div");
                                master_comment.id = "master";

                                for(var key in response){

                                    var add_comments = document.createElement("div");
                                    add_comments.classList.add("added_comments");

                                    var comment_space = document.createElement("div");
                                    comment_space.classList.add("space_comment");

                                    var comment_img_div = document.createElement("div");
                                    comment_img_div.classList.add("div_img_comment");

                                    var img_ramka = document.createElement("div");
                                    img_ramka.classList.add("img_ramka");

                                    var img = document.createElement("img");
                                    img.id = "com_img";
                                    img.src = response[key]['user_pic'];

                                    var comment_content = document.createElement("div");
                                    comment_content.classList.add("content_comment");

                                    var name = document.createElement("h1");
                                    name.classList.add("comment_name");
                                    name.innerText = response[key]['user_name'];

                                    var date = document.createElement("h4");
                                    date.classList.add("comment_date");
                                    date.innerText = response[key]['comment_date'];

                                    var comment = document.createElement("h4");
                                    comment.classList.add("comment");
                                    comment.innerText = response[key]['comment_text'];


                                    document.getElementById(response[key]["twat_id"]).appendChild(master_comment);
                                    master_comment.appendChild(add_comments);
                                    add_comments.appendChild(comment_space);
                                    comment_space.appendChild(comment_img_div);
                                    comment_img_div.appendChild(img_ramka);
                                    img_ramka.appendChild(img);

                                    comment_space.appendChild(comment_content);
                                    comment_content.appendChild(name);
                                    comment_content.appendChild(date);
                                    comment_content.appendChild(comment);
                                }
                            }
                        };
                        request.send();
                    }
                }
            };
            request.send();
        }
        showOtherUsersTwits(queries[0]);

    } else {/*-------------------------------------------------------------------------------------------*/

        /*Георги --27.03.2018-- Ако в URL НЯМА параметър се запълва профила на логнатия потребител*/
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
                var name = document.getElementById("name");
                var name_ = document.getElementById("name_");
                var description = document.getElementById("descriptionid");
                var city = document.getElementById('cityid');
                var reg_date = document.getElementById("reg_date");
                var email = document.getElementById("emailid");
                name.innerText = response['user_name'];
                name_.innerText = "@" + response['user_name'];
                description.innerHTML = response['user_description'];
                city.innerText += 'Живее в: ' + response['user_city'];
                reg_date.innerText = 'Регистриран на: ' + response['user_date'].substring(0, 10);
                email.innerText = 'Имейл: ' + response['user_email'];
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
                                if (password.value == 0) {
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


        /* Георги --27.03.2018--  Втори рекуест (логнат профил) за визуализиране на цифрите на броя юзъри които
        * следва, го следват и публикуваните туитове*/
        function showMynumbers() {
            var request = new XMLHttpRequest();
            request.open("GET", "../controller/showMyProfileController.php");
            request.onreadystatechange = function (ev) {
                if (this.status == 200 && this.readyState == 4) {
                    var response = JSON.parse(this.responseText);

                    var a = document.getElementById("following");
                    var span = document.getElementById('sledva');
                    span.innerText = response[0][0]['num'];

                    var a = document.getElementById("followers");
                    var span = document.getElementById('sledvat');
                    span.innerText = response[1][0]['num'];

                    var a = document.getElementById("twits");
                    var span = document.getElementById('tuitove');
                    span.innerText = response[2][0]['num'];

                }
            };
            request.send();
        }
        showMynumbers();

        /*Георги --27.03.2018--С натискане върху линка "следва" се визуализират прозорци с информация
        * за всеки го следващ юзър, както и бутон за "unfollow" */
        function showFollowing() {
            var request = new XMLHttpRequest();
            request.open("GET", "../controller/showFollowing.php");
            request.onreadystatechange = function (ev) {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);

                    var center = document.getElementById("center_tweet");
                    center.style.width = "869px";
                    center.style.backgroundColor = "transparent";
                    var right = document.getElementById("random_users");
                    right.style.visibility = "hidden";
                    right.style.width = "1px";
                    center.innerHTML = "";
                    for (var key in response) {
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
                        var a = document.createElement("a");
                        a.id = "profile_h4";
                        a.innerText = "@" + response[key]["user_name"];
                        a.href = "profile.php?" + response[key]["user_name"];

                        var button = document.createElement("button");
                        button.id = "btn_unfollow";
                        button.innerText = "Премахни";
                        button.value = response[key]["user_name"];
                        button.addEventListener("click", function () {
                            var name = this.value;
                            var request = new XMLHttpRequest();
                            request.open("GET", "../controller/dislikeItController.php?name=" + name);
                            request.onreadystatechange = function (ev) {
                                if (this.readyState == 4 && this.status == 200) {
                                    var response = JSON.parse(this.responseText);
                                    if (response == "1") {
                                        showFollowing();
                                        showMynumbers();
                                    }
                                }
                            };
                            request.send();
                        });

                        div.appendChild(div_name);
                        div_name.appendChild(user_img);
                        div_name.appendChild(h2);
                        div_name.appendChild(a);
                        div.appendChild(button);
                    }
                }
            };
            request.send();
        }

        /*Георги --29.03.2018--С натискане върху линка "последователи" се визуализират прозорци с информация
         * за всеки последовател*/
        function showFollowers() {
            var request = new XMLHttpRequest();
            request.open("GET", "../controller/showMyFollowersController.php");
            request.onreadystatechange = function (ev) {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);

                    var center = document.getElementById("center_tweet");
                    center.style.width = "869px";
                    var right = document.getElementById("random_users");
                    right.style.visibility = "hidden";
                    right.style.width = "1px";
                    center.innerHTML = "";
                    for (var key in response) {
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
                        var a = document.createElement("a");
                        a.id = "profile_h4";
                        a.innerText = "@" + response[key]["user_name"];
                        a.href = "profile.php?" + response[key]["user_name"];

                        div.appendChild(div_name);
                        div_name.appendChild(user_img);
                        div_name.appendChild(h2);
                        div_name.appendChild(a);
                    }
                }
            };
            request.send();
        }

        /*Георги --27.03.2018--С натискане върху линка "туитове" се визуализират прозорец с всички туитове на потребителя*/
        function showTwits() {
            var center = document.getElementById("center_tweet");
            center.style.width = "600px";
            center.innerHTML = "";
            center.style.backgroundColor = "";
            var right = document.getElementById("random_users");
            right.style.visibility = "visible";
            right.style.width = "280px";
            showMyTwits();
        }

        showMyTwits();
    }

    /*Георги --28.03.2018-- Рекуест за избрани на случаен принцип профили*/
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
                    button.innerText = "Последвай";
                    button.classList.add("follow_btn");
                    button.value = response[key]["user_name"];
                    button.addEventListener("click", function () {
                        var name = this.value;
                        var request = new XMLHttpRequest();
                        request.open("GET", "../controller/likeItController.php?name=" + name);
                        request.onreadystatechange = function (ev) {
                            if (this.readyState == 4 && this.status == 200) {
                                var response = JSON.parse(this.responseText);
                                console.log(response);
                                if (response == "1") {
                                    random();
                                    showMynumbers();
                                }
                            }
                        };
                        request.send();


                    });
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

    /*Георги 01.04.2018 -- Показва туитовете !!!*/
    function showMyTwits() {
        var request = new XMLHttpRequest();
        request.open("GET", "../controller/showMyTweetsController.php");
        request.onreadystatechange = function (ev) {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);
                var center_div = document.getElementById("center_tweet");
                center_div.innerHTML = "";
                for (var key in response) {
                    var tweet = document.createElement("div");
                    tweet.classList.add("tweet");
                    var image_div = document.createElement("div");
                    image_div.classList.add("tweet_image_div");
                    var img = document.createElement("img");
                    img.id = "tweet_image";
                    img.src = response[key]['user_pic'];
                    var tweet_content = document.createElement("tweet_content_div");
                    tweet_content.classList.add("content_div");
                    var name = document.createElement("h1");
                    name.classList.add("tweet_name");
                    name.innerText = response[key]['user_name'];
                    var date = document.createElement("h4");
                    date.classList.add("tweet_date");
                    date.innerText = response[key]['twat_date'];
                    var p = document.createElement("p");
                    p.classList.add("content");
                    p.innerText = response[key]['twat_content'];
                    var a = document.createElement("a");
                    a.innerText = "коментари";
                    a.classList.add("comments");

                    var comments_div = document.createElement("div");
                    comments_div.classList.add("comment_space");
                    comments_div.id = response[key]['twat_id'];
                    var text = document.createElement("input");
                    text.type = "text";
                    text.classList.add("comment_text");
                    text.name = response[key]['twat_id'];
                    text.id = "asd" + response[key]['twat_id'];
                    var button = document.createElement("button");
                    button.classList.add("comment_button");
                    button.innerText = "Изпрати";
                    button.value = response[key]['twat_id'];

                    button.addEventListener("click" , function () {
                        console.log(document.getElementById("asd"+ this.value).value);

                        var request = new XMLHttpRequest();
                        request.open("post", "../controller/sendCommentController.php");
                        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        request.onreadystatechange = function (ev) {
                            if(this.readyState == 4 && this.status == 200){
                                var response = JSON.parse(this.responseText);
                                if(response == "1"){
                                    showMyTwits();
                                }

                            }
                        };
                        request.send("content=" + document.getElementById("asd"+ this.value).value + "&tweetId=" + this.value);

                    });

                    var tweet_id = response[key]['twat_id'];

                    image_div.appendChild(img);
                    tweet.appendChild(image_div);
                    tweet_content.appendChild(name);
                    tweet_content.appendChild(date);
                    tweet_content.appendChild(p);
                    tweet.appendChild(tweet_content);
                    tweet.appendChild(a);
                    center_div.appendChild(tweet);
                    center_div.appendChild(comments_div);
                    comments_div.appendChild(text);
                    comments_div.appendChild(button);

                    /*Георги 01.04.2018 -- Показва коментарите под туитовете !!!*/
                    var request = new XMLHttpRequest();
                    request.open("GET", "../controller/showMyTweetCommentController.php?tweet_id=" + tweet_id);
                    request.onreadystatechange = function (ev) {
                        if (this.readyState == 4 && this.status == 200) {
                            var response = JSON.parse(this.responseText);
                            var master_comment = document.createElement("div");
                            master_comment.id = "master";

                            for(var key in response){

                                var add_comments = document.createElement("div");
                                add_comments.classList.add("added_comments");

                                var comment_space = document.createElement("div");
                                comment_space.classList.add("space_comment");

                                var comment_img_div = document.createElement("div");
                                comment_img_div.classList.add("div_img_comment");

                                var img_ramka = document.createElement("div");
                                img_ramka.classList.add("img_ramka");

                                var img = document.createElement("img");
                                img.id = "com_img";
                                img.src = response[key]['user_pic'];

                                var comment_content = document.createElement("div");
                                comment_content.classList.add("content_comment");

                                var name = document.createElement("h1");
                                name.classList.add("comment_name");
                                name.innerText = response[key]['user_name'];

                                var date = document.createElement("h4");
                                date.classList.add("comment_date");
                                date.innerText = response[key]['comment_date'];

                                var comment = document.createElement("h4");
                                comment.classList.add("comment");
                                comment.innerText = response[key]['comment_text'];


                                document.getElementById(response[key]["twat_id"]).appendChild(master_comment);
                                master_comment.appendChild(add_comments);
                                add_comments.appendChild(comment_space);
                                comment_space.appendChild(comment_img_div);
                                comment_img_div.appendChild(img_ramka);
                                img_ramka.appendChild(img);

                                comment_space.appendChild(comment_content);
                                comment_content.appendChild(name);
                                comment_content.appendChild(date);
                                comment_content.appendChild(comment);
                            }
                        }
                    };
                    request.send();
                }
            }
        };
        request.send();
    }


</script>
</body>
</html>
