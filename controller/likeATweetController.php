<?php

session_start();
require_once "../model/tweetDao.php";

try{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $user_id = $_SESSION['user']['id'];
        $twat_id = $_GET['twat_id'];
        likeATweet($pdo,$twat_id,$user_id);
    }
}catch (PDOException $e){

}
