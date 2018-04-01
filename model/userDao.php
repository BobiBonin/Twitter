<?php
require_once 'dbManager.php';
/*Проверява дали юзъра съществува*/
function checkUserExist($pdo, $email, $pass)
{
    $statement = $pdo->prepare("SELECT COUNT(*) as rows FROM users WHERE user_email = ? AND user_pass = ?");
    $statement->execute(array($email, $pass));
    $result = $statement->fetch();
    return $result['rows'] > 0;
}

/*Проверява дали юзъра съществува по имейл за регистрацията*/
function userExistForReg($pdo, $email)
{
    $statement = $pdo->prepare("SELECT COUNT(*) as rows FROM users WHERE user_email = ?");
    $statement->execute(array($email));
    $result = $statement->fetch();
    return $result['rows'] > 0;
}

/*Записва новия юзър в базата*/
function registerUser($pdo, $username, $password, $email, $date)
{
    $statement = $pdo->prepare("INSERT INTO users (user_name,user_email,user_pass,user_date) VALUES (?,?,?,?)");
    $statement->execute(array($username, $email, $password, $date));
}

/*Взима информация за юзъра по имейл*/
function getUserInfoByEmail($pdo, $email)
{
    $statement = $pdo->prepare("SELECT user_id, user_name, user_email, user_date, user_pic, user_cover, user_city, user_description FROM users WHERE user_email = ?");
    $statement->execute(array($email));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

/*Търси първите 5 потребителя по име (за търсачката)*/
function getFirstFiveUsersByName($pdo, $name, $email)
{
    $statement = $pdo->prepare("SELECT user_name, user_pic, user_cover FROM users WHERE user_name LIKE ? AND NOT user_email = ? LIMIT 5");
    $statement->execute(array($name . "%", $email));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/*Намира броя на следващите дадения потребител юзъри по ИМЕ*/
function getUserFollowings($pdo, $name)
{
    $statement = $pdo->prepare("SELECT COUNT(*) as num FROM users as u JOIN following as f ON u.user_id = f.user_id WHERE u.user_name = ?");
    $statement->execute(array($name));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/*Намира броя на последваните потребители по ИМЕ*/
function getUserFollowers($pdo, $name)
{
    $statement = $pdo->prepare("SELECT COUNT(*) as num FROM following as f JOIN users as u ON u.user_id = f.following_id WHERE u.user_name = ?");
    $statement->execute(array($name));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/*Намира броя на публикуваните туитове по ИМЕ на потребителя*/
function getUserTwits($pdo, $name)
{
    $statement = $pdo->prepare("SELECT COUNT(*) as num FROM twats as t  JOIN users as u  ON u.user_id = t.user_id WHERE u.user_name = ?");
    $statement->execute(array($name));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/*Georgi -- 23.03.2018 -- Търси конкретен юзър по име*/
function getUserInfoByName($pdo, $name)
{
    $statement = $pdo->prepare("SELECT user_id, user_name, user_email, user_date, user_pic, user_cover, user_city, user_description FROM users WHERE user_name = ?");
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

/*Georgi -- 23.03.2018 -- Намира ID на юзър по име*/
function findId($pdo, $name)
{
    $statement = $pdo->prepare("SELECT user_id FROM users WHERE user_name = ?");
    $statement->execute(array($name));
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

/*Намира следващите дадения потребител юзъри по ID*/
function findFollowing($pdo, $id)
{
    $statement = $pdo->prepare("SELECT u.user_name, u.user_pic, u.user_cover, u.user_city, u.user_description FROM users as u JOIN following as f ON u.user_id = f.following_id WHERE f.user_id = ?");
    $statement->execute(array($id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/*Намира следените от дадения потребител юзъри по ID*/
function findFollowers($pdo, $id)
{
    $statement = $pdo->prepare("SELECT u.user_name, u.user_pic, u.user_cover FROM users as u JOIN following as f ON u.user_id = f.user_id WHERE f.following_id = ?");
    $statement->execute(array($id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/*Избира произволни 3 юзъра*/
function getFourRandomUsers($pdo,$email){
    $statement = $pdo->prepare("SELECT user_name, user_pic FROM users  WHERE user_id < (SELECT COUNT(*) FROM users) AND NOT user_email = ?  ORDER BY RAND()  LIMIT 3 ");
    $statement->execute(array($email));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

/*Харесва потребител*/
function likeIt($pdo,$me,$you){
    $statement = $pdo->prepare("INSERT INTO following (user_id,following_id) VALUES (?,?)");
    $statement->execute(array($me,$you));
    $result = $statement->rowCount();
    return $result;
}

/**/
function isFollow($pdo,$myid, $id){
    $statement = $pdo->prepare("SELECT * FROM following WHERE user_id = ? AND following_id = ?");
    $statement->execute(array($myid,$id));
    $result = $statement->rowCount();
    return $result;
}

/*Отхаресва потребител*/
function dislikeIt($pdo,$me,$you){
    $statement = $pdo->prepare("DELETE FROM following WHERE user_id = ? AND following_id = ?");
    $statement->execute(array($me,$you));
    $result = $statement->rowCount();
    return $result;
}

/*Взима following ID*/
function getFollowersId($pdo,$user_id){
    $statement = $pdo->prepare("SELECT following_id from mydb.following WHERE user_id = ?");
    $statement->execute(array($user_id));
    $result = $statement->fetchAll(PDO::FETCH_COLUMN);
    return $result;
}

/*Взима инфо за юзъра по ID*/
function getUserInfoById($pdo, $id)
{
    $statement = $pdo->prepare("SELECT user_id, user_name, user_email, user_date, user_pic, user_cover, user_city, user_description FROM users WHERE user_id = ?");
    $statement->execute(array($id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
