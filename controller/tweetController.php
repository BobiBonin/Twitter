<?php
session_start();
$user = $_SESSION['user']['id'];
$text = htmlentities($_GET['text']);
require_once "../model/tweetDao.php";

addTweet($pdo,$text,$user);
