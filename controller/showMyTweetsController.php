<?php
session_start();

use \model\TweetDao;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

try {
    $id = $_SESSION['user']['id'];
    $dao = new TweetDao();
    $result = $dao->showMyTweets($id);
    echo json_encode($result);

} catch (PDOException $e) {

}