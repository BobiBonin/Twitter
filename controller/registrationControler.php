<?php

session_start();

use \model\UserDao;
use \model\User;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

if (isset($_POST['reg_btn'])) {
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $rpassword = htmlentities($_POST['rpassword']);
    $username = htmlentities($_POST['username']);
    $error = false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
    }
    if ($password !== $rpassword) {
        $error == true;
    }
    if (strlen($username) < 3 && strlen($username) > 20) {
        $error == true;
    }
    try {
        if (!$error) {
            $user = new User($email, sha1($password), $username);
            $pdo = new UserDao();
            $result = $pdo->userExistForReg($user);
            if (!$result) {
                $pdo->registerUser($user);
                $info = $pdo->getUserInfoByEmail($user);
                $_SESSION['user'] = [];
                $new = [
                    "id" => $info['user_id'],
                    "name" => $info['user_name'],
                    "reg_date" => $info['user_date'],
                    "image" => $info['user_pic'],
                    "cover" => $info['user_cover'],
                    "city" => $info['user_city'],
                    "description" => $info['user_description'],
                    "email" => $email,
                ];
                $_SESSION['user'] = $new;
                header("Location: ../view/home.php");
            } else {
                header("location: ../index.html"); //User all ready EXIST!!
            }
        } else {
            header("location: ../index.html"); // ERRORS!
        }
    } catch (Exception $exception) {

    }
}