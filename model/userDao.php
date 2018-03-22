<?php

function checkUserExist($email, $pass){
    require_once 'dbManager.php';
    $statement = $pdo->prepare("SELECT COUNT(*) as rows FROM users WHERE user_email = ? AND user_pass = ?");
    $statement->execute(array($email, $pass));
    $result = $statement->fetch();
    return $result['rows'] > 0;
}

function UserExistForReg($pdo, $email){
    $statement = $pdo->prepare("SELECT COUNT(*) as rows FROM users WHERE user_email = ?");
    $statement->execute(array($email));
    $result = $statement->fetch();
    return $result['rows'] > 0;
}

function registerUser($pdo, $username, $password, $email, $date){
    $statement = $pdo->prepare("INSERT INTO users (user_name,user_email,user_pass,user_date) VALUES (?,?,?,?)");
    $statement->execute(array($username, $email, $password, $date));
}

function getUserInfoByEmail($email){
    require_once "dbManager.php";
    $statement = $pdo->prepare("SELECT user_name, user_email, user_date, user_pic, user_cover FROM users WHERE user_email = ?");
    $statement->execute(array($email));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}