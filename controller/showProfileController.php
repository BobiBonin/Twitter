<?php
session_start();
require_once "../model/userDao.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $name = $_GET['name'];
    $user = getUserInfoByName2($name);
    echo json_encode($user);
}
