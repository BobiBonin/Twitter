<?php
/*Georgi -- 23.03.2018 -- Търси юзър по имейл*/
session_start();
require_once "../model/userDao.php";

try {

    $logged_mail = $_SESSION["user"]['email'];
    $user = getUserInfoByEmail($pdo, $logged_mail);
    echo json_encode($user);

} catch (PDOException $e) {

}
