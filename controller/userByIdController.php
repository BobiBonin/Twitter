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
        $id = htmlentities($_GET['id']);
        $user = new User(null, null, null, null, null, null, null, $id);
        $dao = new UserDao();
        $json = $dao->getUserInfoById($user);
        echo json_encode($json);
    }
} catch (Exception $exception) {

}


