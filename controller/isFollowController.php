<?php

session_start();
require_once "../model/userDao.php";

try {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $me = $_SESSION['user']['id'];
        $name = $_GET['name'];
        $id = findId($pdo, $name);
        $result = isFollow($pdo, $me,$id['user_id']);
        echo json_encode($result);
    }
} catch (PDOException $e) {

}