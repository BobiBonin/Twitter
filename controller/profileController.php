<?php
/*Georgi -- 23.03.2018 -- Търси юзър по имейл*/
session_start();

use \model\UserDao;
use \model\User;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

try {
    $logged_mail = $_SESSION["user"]['email'];
    $user = new User($logged_mail);
    $dao = new UserDao();
    $result = $dao->getUserInfoByEmail($user);
    echo json_encode($result);

} catch (PDOException $e) {

}
