<?php

session_start();

use \model\UserDao;
use \model\User;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

if (isset($_POST['login_btn'])) {
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);

    try {
        $user = new User($email, sha1($password));
        $pdo = new UserDao();
        $result = $pdo->checkUserExist($user);

        if ($result) {
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
            header("Location: ../view/error_login.html");
        }
    } catch (Exception $exception) {

    }
}


