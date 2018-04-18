<?php

session_start();

use \model\TweetDao;
use \model\UserDao;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

try{
    $uDao = new UserDao();
    $tDao = new TweetDao();

    $user_id = $_SESSION['user']['id'];

    $arr = $uDao->getFollowersId($user_id);

    $string="twats.user_id = ".$user_id." OR ";
    for ($i=0;$i<count($arr);$i++){
        $string=$string."twats.user_id = $arr[$i]";
        if ($i < count($arr)-1){
            $string  = $string." OR ";
        }
    }
    $tDao->getMyFollowersTweets($string);
} catch (Exception $exception){

}

