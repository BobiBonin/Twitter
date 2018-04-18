<?php
session_start();

use \model\CommentDao;
use \model\Comment;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}


try{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user']['id'];
        $content = $_POST['content'];
        $tweet_id = $_POST['tweetId'];
        $comment = new Comment($tweet_id,$content,$user_id);
        $dao = new CommentDao();
        $comments = $dao->addComment($comment);
        echo json_encode($comments);
    }
} catch (Exception $exception){

}
