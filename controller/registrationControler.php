<?php

session_start();
require_once "../model/userDao.php";

if (isset($_POST['reg_btn'])) {
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $rpassword = htmlentities($_POST['rpassword']);
    $username = htmlentities($_POST['username']);

    try {
        require_once'../model/dbManager.php';
        if($password === $rpassword){
            if(!UserExistForReg($pdo, $email)){
                $date = date("y-m-d H:i:s");
                registerUser($pdo,$username,sha1($password),$email,$date);
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
                header("location: ../view/home.php");
            }else{
                header("location: ../index.html");
            }
        }else{
            header("location: ../index.html");
        }
    } catch (PDOException $e) {
        header("location: ../view/error_page.html");
    }
}