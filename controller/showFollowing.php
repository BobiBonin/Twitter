<?php
session_start();
require_once "../model/userDao.php";

try{
    $id = $_SESSION['user']['id'];
    $result = findFollowing($pdo, $id);
    echo json_encode($result);

}catch (PDOException $e){

}

