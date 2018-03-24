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
        ?>
    </div>
    <div id="home_right_div">

    </div>
</div>
</body>
</html>