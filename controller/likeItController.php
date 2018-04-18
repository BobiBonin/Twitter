<?php

session_start();

use \model\UserDao;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}


try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $me = $_SESSION['user']['id'];
        $name = $_GET['name'];
        $dao = new UserDao();
        $you = $dao->findId($name);
        $like = $dao->likeIt($me, $you['user_id']);
        echo json_encode($like);
    }
} catch (PDOException $e) {

}