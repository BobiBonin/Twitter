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
                $_SESSION['user'] = $email;
                header("location: ../view/profile.php");
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