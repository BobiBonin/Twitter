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
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $name = $_GET['name'];

        $user = new User(null, null, $name);
        $pdo = new UserDao();

        $result = $pdo->getUserFollowings($user);
        $digits[] = $result;
        $result = $pdo->getUserFollowers($user);
        $digits[] = $result;
        $result = $pdo->getUserTwits($user);
        $digits[] = $result;
        echo json_encode($digits);
    }
}catch (PDOException $e){

}