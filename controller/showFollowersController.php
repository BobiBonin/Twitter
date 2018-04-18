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
        $name = $_GET['name'];
        $dao = new UserDao();
        $id = $dao->findId($name);
        $user = new User(null,null,null,null,null,null,null,$id['user_id']);
        $result = $dao->findFollowers($user);

        echo json_encode($result);
    }
} catch (PDOException $e) {

}
