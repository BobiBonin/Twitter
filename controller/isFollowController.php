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
        $my = $_SESSION['user']['id'];
        $name = htmlentities($_GET['name']);
        $dao = new UserDao();
        $id = $dao->findId($name);
        $result = $dao->isFollow($my,$id['user_id']);
        echo json_encode($result);
    }
} catch (PDOException $e) {

}