<?php
session_start();

use \model\TweetDao;
use \model\Tweet;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

try {
    $user = $_SESSION['user']['id'];
    $text = htmlentities($_GET['text']);

    $tweet = new Tweet(null, $user, null, $text);
    $dao = new TweetDao();
    $dao->addTweet($tweet);
} catch (Exception $exception) {

}






