<?php
session_start();
require_once "../model/tweetDao.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $date = date("y-m-d H:i:s");
    $content = $_POST['content'];
    $tweet_id = $_POST['tweetId'];
    $comments = addComment($pdo,$tweet_id,$date,$content,$user_id);
    echo json_encode($comments);
}
