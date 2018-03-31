<?php


session_start();
require_once "../model/userDao.php";

try{
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $me = $_SESSION['user']['id'];
        $name = $_GET['name'];
        $you = findId($pdo, $name);
        $asd =  dislikeIt($pdo,$me,$you['user_id']);
        echo json_encode($asd);
    }
}catch (PDOException $e){

}