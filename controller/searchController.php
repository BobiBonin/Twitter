<?php
/*Georgi -- 23.03.2018 -- Търси юзър по име ако има гет реклуест (за аякс и минаването от профил в профил)*/
session_start();
require_once "../model/userDao.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = $_GET['name'];
    $user = getUserInfoByName($name, $_SESSION['email']);
    echo json_encode($user);
}
