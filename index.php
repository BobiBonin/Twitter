<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Twatter. Това което се случва</title>
    <link rel="stylesheet" href="view/assets/style/login_style.css">
    <link rel="stylesheet" href="view/assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="view/assets/images/Tweeter_icon.png"/>
</head>
<body>
<div id="main">
    <section id="left">
        <img src="view/assets/images/Tweeter_bird5.png" alt="">
        <div id="static_sentences">
            <div id="first">
                <i class="fa fa-search fa-2x position" aria-hidden="true"></i>
                <p>Следвай интересите си.</p>
            </div>
            <div id="second">
                <i class="fa fa-users fa-2x position" aria-hidden="true"></i>
                <p>Разбери за какво говорят хората.</p>
            </div>
            <div id="third">
                <i class="fa fa-comment-o fa-2x position" aria-hidden="true"></i>
                <p>Включи се в разговора.</p>
            </div>
        </div>
    </section>

    <section id="right">
        <div id="login">
            <form method="post" id="login_form" action="controller/loginControler.php">
                <input id="input_left" class="input" type="email" required placeholder="Имейл адрес" name="email">
                <input class="input" type="password" placeholder="Парола" name="password" required>
                <input id="button" type="submit" value="Вход" name="login_btn">
            </form>
        </div>
        <div id="registration">
            <img src="view/assets/images/Tweeter_icon.png" alt="">
            <h1>Виж какво се случва по света в момента</h1>
            <h3>Присъедини се към Twitter днес.</h3>
            <form id="reg_form" method="post" action="controller/registrationControler.php">
                <div id="reg_user_div">
                    <input id="reg_name" type="text" class="reg_input" placeholder="Имейл адрес" name="email">
                    <span id="span"></span>
                </div>
                <div id="reg_pass_div">
                    <input id="reg_pass" type="password" class="reg_input" placeholder="Парола" name="password">
                    <span id="span2"></span>
                </div>
            </form>
            <div id="allready_have">
                <button class="reg_button" onclick="showAll()">Първи стъпки</button>
                <h4>Вече имаш профил? <a href="#">Вход</a></h4>
            </div>
        </div>
    </section>

    <footer id="footer">
        <div id="copy">
            <h4>&copy; 2018 IT Tallents Georgi Gamishev, Boris Bonin</h4>
        </div>
    </footer>
</div>
<script>
    function myFunction(x, y) {
        if (x.matches) { // If media query matches
            var button = document.getElementById("button");
            var div = document.getElementById("registration");
            var form = document.getElementById("login_form");
            if (form.style.visibility === "visible") {
                form.style.visibility = "hidden";
                button.style.cssFloat = "right";
                button.style.top = "0";
                button.style.right = "0";
                button.style.position = "absolute";
                div.appendChild(button);
            }
        } else {
            if (document.getElementById("reg_form").length === 2) {
                var button = document.getElementById("button");
                var form = document.getElementById("login_form");
                form.style.visibility = "visible";
                button.style.cssFloat = "";
                button.style.top = "";
                button.style.right = "";
                button.style.position = "";
                form.appendChild(button);
            }
        }
    }

    var x = window.matchMedia("(max-width: 1137px)");
    var y = window.matchMedia("(max-height: 600px)");
    myFunction(x, y); // Call listener function at run time
    x.addListener(myFunction);
    y.addListener(myFunction);

    function myFunction2(width) {
        if (width.matches) { // If media query matches
            var right = document.getElementById("right");
            var left = document.getElementById("left");
            var footer = document.getElementById("footer");
            footer.style.position = "relative";
            right.style.width = "100%";
            left.style.width = "100%";
            left.style.height = "50%";
            left.style.clear = "both";

        } else {
            var right = document.getElementById("right");
            var left = document.getElementById("left");
            var footer = document.getElementById("footer");
            footer.style.position = "";
            right.style.width = "";
            left.style.width = "";
            left.style.height = "";
        }
    }

    var width = window.matchMedia("(max-width: 768px)");
    myFunction(width);
    width.addListener(myFunction2);

    function showAll() {
        var user = document.getElementById("reg_name");
        var pass = document.getElementById("reg_pass");
        var form = document.getElementById("reg_form");

        if (user.value != 0 && pass.value != 0) {
            if (validateEmail(user.value) == true) {
                var repeat_pass_div = document.createElement("div");
                var repeat_pass = document.createElement("input");
                var span3 = document.createElement("span");
                var span = document.getElementById("span");
                var span2 = document.getElementById("span2");
                span.innerText = "";
                span2.innerText = "";
                span3.id = "span3";
                repeat_pass_div.id = "repeat_pass_div";
                repeat_pass.className = "reg_input";
                repeat_pass.name = "rpassword";
                repeat_pass.placeholder = "Повторете паролата";
                repeat_pass.type = "password";

                var username_div = document.createElement("div");
                var username = document.createElement("input");
                var span4 = document.createElement("span");

                username_div.id = "username_div";
                span4.id = "span4";

                username.className = "reg_input";
                username.name = "username";
                username.placeholder = "Потребителско име";
                username.type = "text";
                repeat_pass_div.appendChild(repeat_pass);
                repeat_pass_div.appendChild(span3);
                username_div.appendChild(username);
                username_div.appendChild(span4);
                form.appendChild(repeat_pass_div);
                form.appendChild(username_div);

                var div = document.getElementById("allready_have");
                var reg_form = document.getElementById("reg_form");
                var submit = document.createElement("input");

                div.style.visibility = "hidden";
                submit.type = "submit";
                submit.className = "reg_button";
                submit.style.width = "350px";
                submit.name = "reg_btn";
                submit.value = "Регистрация";
                submit.addEventListener('click', function (event) {

                    var span = document.getElementById("span");
                    var span2 = document.getElementById("span2");
                    var span3 = document.getElementById("span3");
                    var span4 = document.getElementById("span4");
                    span.style.color = "rgba(224,36,94,0.71)";
                    span2.style.color = "rgba(224,36,94,0.71)";
                    span3.style.color = "rgba(224,36,94,0.71)";
                    span4.style.color = "rgba(224,36,94,0.71)";

                    if (user.value == 0) {
                        if (validateEmail(user.value) == false) {
                            user.style.border = "1px solid rgba(224,36,94,0.71)";
                            span.innerText = "Моля въведете валиден имейл адрес!";
                            event.preventDefault();
                        }
                        user.style.border = "1px solid rgba(224,36,94,0.71)";
                        span.innerText = "Моля въведете имейл адрес!";
                        event.preventDefault();
                    } else {
                        if (validateEmail(user.value) == false) {
                            user.style.border = "1px solid rgba(224,36,94,0.71)";
                            span.innerText = "Моля въведете валиден имейл адрес!";
                            event.preventDefault();
                        } else {
                            span.innerText = "";
                            user.style.border = "1px solid rgba(23, 190, 99, 0.71)";
                        }
                    }
                    if (pass.value == 0) {
                        pass.style.border = "1px solid rgba(224,36,94,0.71)";
                        span2.innerText = "Моля въведете парола!";
                        event.preventDefault();
                    } else {
                        span2.innerText = "";
                        pass.style.border = "1px solid rgba(23, 190, 99, 0.71)";
                    }
                    if (repeat_pass.value == 0) {
                        repeat_pass.style.border = "1px solid rgba(224,36,94,0.71)";
                        span3.innerText = "Моля повторете паролата!";
                        event.preventDefault();
                    } else {
                        span3.innerText = "";
                        repeat_pass.style.border = "1px solid rgba(23, 190, 99, 0.71)";
                    }
                    if (username.value == 0) {
                        username.style.border = "1px solid rgba(224,36,94,0.71)";
                        span4.innerText = "Моля въведете пълно име!";
                        event.preventDefault();
                    } else {
                        span4.innerText = "";
                        username.style.border = "1px solid rgba(23, 190, 99, 0.71)";
                    }
                }, false);
                reg_form.appendChild(submit);
                var login = document.getElementById("login_form");
                index.style.visibility = "hidden";
                var registration_div = document.getElementById("registration");
                registration_div.style.marginTop = "10%";
                pass.style.border = "";
                user.style.border = "";
            } else {
                var span = document.getElementById("span");
                var span2 = document.getElementById("span2");
                span.style.color = "rgba(224,36,94,0.71)";
                span2.style.color = "rgba(224,36,94,0.71)";

                user.style.border = "1px solid rgba(224,36,94,0.71)";
                span.innerText = "Моля въведете правилен имейл адрес!";
            }
        }
        else {
            var span = document.getElementById("span");
            var span2 = document.getElementById("span2");
            span.style.color = "rgba(224,36,94,0.71)";
            span2.style.color = "rgba(224,36,94,0.71)";

            if (pass.value == 0) {
                pass.style.border = "1px solid rgba(224,36,94,0.71)";
                span2.innerText = "Моля въведете парола!";
            } else {
                span2.innerText = "";
                pass.style.border = "1px solid rgba(23, 190, 99, 0.71)";
            }
            if (user.value == 0) {
                user.style.border = "1px solid rgba(224,36,94,0.71)";
                span.innerText = "Моля въведете имейл!";
            } else {
                span.innerText = "";
                user.style.border = "1px solid rgba(23, 190, 99, 0.71)";
            }
        }
    }

    function validateEmail(email) {
        var exp = /(\w(=?@)\w+\.{1}[a-zA-Z]{2,})/i
        return (exp.test(email));
    }
</script>
</body>
</html>