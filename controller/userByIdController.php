<?php

session_start();
require_once "../model/userDao.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET['id'];
        $json = getUserInfoById($pdo,$id);
        echo json_encode($json);
    }
} catch (PDOException $e) {

}


