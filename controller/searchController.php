<?php
/*Georgi -- 23.03.2018 -- Търси юзър по име LIMIT 5*/
session_start();

use \model\UserDao;
use \model\User;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $name = htmlentities($_GET['name']);
        $dao = new UserDao();
        $user = new User($_SESSION['user']['email'], 0, $name);
        $users = $dao->getFirstFiveUsersByName($user);
        echo json_encode($users);
    } catch (Exception $exception) {

    }

}
