<?php

session_start();
require_once "../model/userDao.php";

if (isset($_POST['login_btn'])) {
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);

    try {
        if (checkUserExist($pdo,$email, sha1($password))) {
            $result = getUserInfoByEmail($pdo, $email);
            $_SESSION['user'] = [];
            $new = [
                "id" => $result['user_id'],
                "name" => $result['user_name'],
                "reg_date" => $result['user_date'],
                "image" => $result['user_pic'],
                "cover" => $result['user_cover'],
                "city" => $result['user_city'],
                "description" => $result['user_description'],
                "email" => $email,
            ];
            $_SESSION['user'] = $new;
            header("Location: ../view/home.php");
        }else{
            header("Location: ../view/error_login.html");
        }
    } catch (PDOException $e) {
        echo "NESHTO STANA VE MANQK!!!";
    }
}