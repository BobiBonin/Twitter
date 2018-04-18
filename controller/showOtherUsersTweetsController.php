<?php
session_start();

use \model\UserDao;
use \model\TweetDao;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

try{
    $name = htmlentities($_GET['name']);
    $uDao = new UserDao();
    $tDao = new TweetDao();
    $you = $uDao->findId($name);
    $result = $tDao->showMyTweets($you['user_id']);
    echo json_encode($result);
} catch (Exception $exception){

}


