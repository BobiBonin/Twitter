<?php
session_start();
require_once "../model/tweetDao.php";
require_once "../model/userDao.php";



    $name = $_GET['name'];
    $you = findId($pdo, $name);
    $result = showMyTweets($pdo,$you['user_id']);
    echo json_encode($result);

