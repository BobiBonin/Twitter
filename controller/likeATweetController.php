<?php

session_start();

use \model\TweetDao;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}


try{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $dao = new TweetDao();
        $user_id = $_SESSION['user']['id'];
        $twat_id = $_GET['twat_id'];
        $dao->likeATweet($twat_id,$user_id);
    }
}catch (PDOException $e){

}
