<?php
session_start();
$id = $_SESSION['user']['id'];
require_once "../model/tweetDao.php";

showUserTweets($pdo,$id);

