<?php

session_start();
$user_id = $_SESSION['user']['id'];
require_once "../model/tweetDao.php";
require_once "../model/userDao.php";

$arr = getFollowersId($pdo,$user_id);
$string="";
for ($i=0;$i<count($arr);$i++){
    $string=$string."twats.user_id = $arr[$i]";
    if ($i < count($arr)-1){
        $string  = $string." OR ";
    }
}
asd($pdo,$string);