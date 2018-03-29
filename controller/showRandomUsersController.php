<?php
session_start();
require_once "../model/userDao.php";

try {
    $email = $_SESSION['user']['email'];
    $random_users = getFourRandomUsers($pdo,$email);
    echo json_encode($random_users);

} catch (PDOException $e) {

}
