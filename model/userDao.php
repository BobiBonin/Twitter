<?php

function checkUserExist($email, $pass)
{
    require_once 'dbManager.php';
    $statement = $pdo->prepare("SELECT COUNT(*) as rows FROM users WHERE user_email = ? AND user_pass = ?");
    $statement->execute(array($email, $pass));
    $result = $statement->fetch();
    return $result['rows'] > 0;
}

function UserExistForReg($pdo, $email)
{
    $statement = $pdo->prepare("SELECT COUNT(*) as rows FROM users WHERE user_email = ?");
    $statement->execute(array($email));
    $result = $statement->fetch();
    return $result['rows'] > 0;
}

function registerUser($pdo, $username, $password, $email, $date)
{
    $statement = $pdo->prepare("INSERT INTO users (user_name,user_email,user_pass,user_date) VALUES (?,?,?,?)");
    $statement->execute(array($username, $email, $password, $date));
}

function getUserInfoByEmail($email)
{
    require_once "dbManager.php";
    $statement = $pdo->prepare("SELECT user_name, user_email, user_date, user_pic, user_cover FROM users WHERE user_email = ?");
    $statement->execute(array($email));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

/*Georgi -- 23.03.2018 -- Търси юзъри по име без логнатия потребител*/
function getUserInfoByName($name, $email)
{
    require_once "dbManager.php";
    $statement = $pdo->prepare("SELECT user_name, user_pic, user_cover FROM users WHERE user_name LIKE ? AND NOT user_email = ? LIMIT 5");
    $statement->execute(array($name . "%", $email));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
/*Georgi -- 23.03.2018 -- Търси конкретен юзър по име*/
function getUserInfoByName2($name)
{
    require_once "dbManager.php";
    $statement = $pdo->prepare("SELECT user_name, user_pic, user_cover FROM users WHERE user_name = ?");
    $statement->execute(array($name));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/*Georgi -- 23.03.2018 -- Ъпдейтва профила*/
function updateUser($pdo, $username, $email, $password, $img, $cover, $id)
{
    $statement = $pdo->prepare("UPDATE users SET user_name = ?,user_email = ?,user_pass = ?,user_pic = ?,user_cover = ? WHERE user_id = ?");
    $statement->execute(array($username, $email, $password, $img, $cover, $id));
}

/*Georgi -- 23.03.2018 -- Намира ID на юзър по имейл*/
function findId($pdo, $email)
{
    $statement = $pdo->prepare("SELECT user_id FROM users WHERE user_email = ?");
    $statement->execute(array($email));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

