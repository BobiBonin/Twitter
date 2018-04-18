<?php
session_start();

use \model\UserDao;
use \model\User;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $name = htmlentities($_GET['name']);
        $user = new User(null, null, $name);
        $pdo = new UserDao();

        $digits[] = $pdo->getUserFollowings($user);
        $digits[] = $pdo->getUserFollowers($user);
        $digits[] = $pdo->getUserTwits($user);
        echo json_encode($digits);
    }
} catch (Exception $exception) {

}

