<?php
session_start();

use \model\UserDao;


function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

try {
    $dao = new UserDao();
    $email = $_SESSION['user']['email'];
    $random_users = $dao->getFourRandomUsers($email);
    echo json_encode($random_users);
} catch (PDOException $e) {

}
