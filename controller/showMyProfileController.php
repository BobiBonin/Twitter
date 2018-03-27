<?php

session_start();
require_once "../model/userDao.php";
try{
        $name = $_SESSION['user']['name'];
        $user[] = getUserFollowings($pdo, $name);
        $user[] =  getUserFollowers($pdo, $name);
        $user[] = getUserTwits($pdo, $name);
        echo json_encode($user);

}catch (PDOException $e){

}