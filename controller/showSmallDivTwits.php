<?php

session_start();
require_once "../model/userDao.php";
try{
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $name = $_GET['name'];
        $user[] = getUserFollowings($pdo, $name);
        $user[] =  getUserFollowers($pdo, $name);
        $user[] = getUserTwits($pdo, $name);
        echo json_encode($user);
    }
}catch (PDOException $e){

}