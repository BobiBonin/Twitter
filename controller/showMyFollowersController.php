<?php
session_start();

use \model\UserDao;
use \model\User;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

try{
    $id = $_SESSION['user']['id'];
    $user = new User(null,null,null,null,null,null,null,$id);
    $dao = new UserDao();
    $result = $dao->findFollowers($user);
    echo json_encode($result);

}catch (PDOException $e){

}