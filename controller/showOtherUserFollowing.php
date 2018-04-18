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
        $dao = new UserDao();
        $name = $_GET['name'];
        $id = $dao->findId($name);
        $result = $dao->findFollowing($id['user_id']);
        echo json_encode($result);
    }
} catch (PDOException $e) {

}

