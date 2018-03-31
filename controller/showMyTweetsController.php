<?php
session_start();
require_once "../model/tweetDao.php";

try{
        $id = $_SESSION['user']['id'];
        $result = showMyTweets($pdo,$id);
        echo json_encode($result);

}catch (PDOException $e){

}