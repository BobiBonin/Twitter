<?php
session_start();

use \model\CommentDao;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}


try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $dao = new CommentDao();
        $id = $_GET['tweet_id'];
        $comments = $dao->showMyComments($id);
        echo json_encode($comments);
    }
} catch (Exception $exception) {

}

