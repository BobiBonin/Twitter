<?php
session_start();
require_once "../model/tweetDao.php";


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['tweet_id'];
    $comments = showMyComments($pdo,$id);
    echo json_encode($comments);
}
