<?php
/*Georgi -- 23.03.2018 -- Търси юзър по име LIMIT 5*/
session_start();
require_once "../model/userDao.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = $_GET['name'];
    $user = getUserInfoByName($pdo,$name, $_SESSION['email']);
    echo json_encode($user);
}
