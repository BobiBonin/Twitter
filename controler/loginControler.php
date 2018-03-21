<?php

session_start();
require_once "../model/userDao.php";

if (isset($_POST['login_btn'])) {
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);

    try {
        if (checkUserExist($email, sha1($password))) {
            $_SESSION['user'] = $email;
            header("Location: ../view/profile.php");
        }else{
            header("Location: ../view/error_login.html");
        }
    } catch (PDOException $e) {
        echo "NESHTO STANA VE MANQK!!!";
    }
}