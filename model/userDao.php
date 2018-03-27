<?php
require_once 'dbManager.php';

function checkUserExist($pdo, $email, $pass)
{
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

function getUserInfoByEmail($pdo, $email)
{
    $statement = $pdo->prepare("SELECT user_id, user_name, user_email, user_date, user_pic, user_cover, user_city, user_description FROM users WHERE user_email = ?");
    $statement->execute(array($email));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

/*Georgi -- 23.03.2018 -- Търси юзъри по име без логнатия потребител*/
function getUserInfoByName($pdo, $name, $email)
{
    $statement = $pdo->prepare("SELECT user_name, user_pic, user_cover FROM users WHERE user_name LIKE ? AND NOT user_email = ? LIMIT 5");
    $statement->execute(array($name . "%", $email));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getUserFollowings($pdo, $name)
{
    $statement = $pdo->prepare("SELECT COUNT(*) as num FROM users as u JOIN following as f ON u.user_id = f.user_id WHERE u.user_name = ?");
    $statement->execute(array($name));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getUserFollowers($pdo, $name)
{
    $statement = $pdo->prepare("SELECT COUNT(*) as num FROM following as f JOIN users as u ON u.user_id = f.following_id WHERE u.user_name = ?");
    $statement->execute(array($name));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function getUserTwats($pdo, $name)
{
    $statement = $pdo->prepare("SELECT COUNT(*) as num FROM twats as t  JOIN users as u  ON u.user_id = t.user_id WHERE u.user_name = ?");
    $statement->execute(array($name));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


/*Georgi -- 23.03.2018 -- Търси конкретен юзър по име*/
function getUserInfoByName2($pdo, $name)
{
    $statement = $pdo->prepare("SELECT user_name, user_pic, user_cover FROM users WHERE user_name = ?");
    $statement->execute(array($name));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/*Georgi -- 23.03.2018 -- Ъпдейтва профила*/
function updateUser($pdo, $username, $email, $password, $img, $cover, $city, $description, $id)
{
    $statement = $pdo->prepare("UPDATE users SET user_name = ?,user_email = ?,user_pass = ?,user_pic = ?,user_cover = ?, user_city = ?, user_description = ? WHERE user_id = ?");
    $statement->execute(array($username, $email, $password, $img, $cover, $city, $description, $id));
}

/*Georgi -- 23.03.2018 -- Намира ID на юзър по имейл*/
function findId($pdo, $email)
{
    $statement = $pdo->prepare("SELECT user_id FROM users WHERE user_email = ?");
    $statement->execute(array($email));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}
function findFollowing($pdo, $id)
{
    $statement = $pdo->prepare("SELECT u.user_name, u.user_pic, u.user_cover, u.user_city, u.user_description FROM users as u JOIN following as f ON u.user_id = f.following_id WHERE f.user_id = ?");
    $statement->execute(array($id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

