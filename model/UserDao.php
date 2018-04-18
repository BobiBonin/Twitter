<?php
/**
 * Created by PhpStorm.
 * User: gamig
 * Date: 4/17/2018
 * Time: 10:26 AM
 */

namespace model;

use model\User;

class UserDao
{
    const DB_NAME = "mydb";
    const DB_IP = "94.26.37.108";
    const DB_PORT = "3306";
    const DB_USER = "gamigata";
    const DB_PASS = "kaish";

    private $pdo;

    public function __construct(){
        try {
            $this->pdo = new \PDO("mysql:host=" . self::DB_IP . ":" . self::DB_PORT . ";dbname=" . self::DB_NAME, self::DB_USER, self::DB_PASS);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Problem with db query  - " . $e->getMessage();
        }
    }


    /*Проверява дали юзъра съществува за LOGIN*/
    public function checkUserExist(User $user){
        $statement = $this->pdo->prepare("SELECT COUNT(*) as rows FROM users WHERE user_email = ? AND user_pass = ?");
        $statement->execute(array($user->getEmail(), $user->getPassword()));
        $result = $statement->fetch();
        return $result['rows'] > 0;
    }

    /*Взима информация за текущо логнатия юзър по имейл*/
    public function getUserInfoByEmail(User $user){
        $statement = $this->pdo->prepare("SELECT user_id, user_name, user_email, user_date, user_pic, user_cover, user_city, user_description FROM users WHERE user_email = ?");
        $statement->execute(array($user->getEmail()));
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    /*Проверява дали юзъра съществува по имейл за регистрацията*/
    public function userExistForReg(User $user){
        $statement = $this->pdo->prepare("SELECT COUNT(*) as rows FROM users WHERE user_email = ?");
        $statement->execute(array($user->getEmail()));
        $result = $statement->fetch();
        return $result['rows'] > 0;
    }

    /*Регистрира ЮЗЪР*/
    public function registerUser(User $user){
        $statement = $this->pdo->prepare("INSERT INTO users (user_name,user_email,user_pass) VALUES (?,?,?)");
        $statement->execute(array($user->getUsername(),
            $user->getEmail(),
            $user->getPassword()
        ));
    }

    /*Търси първите 5 потребителя по име (за търсачката)*/
    public function getFirstFiveUsersByName(User $user){
        $statement = $this->pdo->prepare("SELECT user_name, user_pic, user_cover FROM users WHERE user_name LIKE ? AND NOT user_email = ? LIMIT 5");
        $statement->execute(array($user->getUsername() . "%", $user->getEmail()));
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /*Намира броя на следващите дадения потребител юзъри по ИМЕ*/
    public function getUserFollowings(User $user){
        $statement = $this->pdo->prepare("SELECT COUNT(*) as num FROM users as u JOIN following as f ON u.user_id = f.user_id WHERE u.user_name = ?");
        $statement->execute(array($user->getUsername()));
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /*Намира броя на последваните потребители по ИМЕ*/
    public function getUserFollowers(User $user){
        $statement = $this->pdo->prepare("SELECT COUNT(*) as num FROM following as f JOIN users as u ON u.user_id = f.following_id WHERE u.user_name = ?");
        $statement->execute(array($user->getUsername()));
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /*Намира броя на публикуваните туитове по ИМЕ на потребителя*/
    public function getUserTwits(User $user){
        $statement = $this->pdo->prepare("SELECT COUNT(*) as num FROM twats as t  JOIN users as u  ON u.user_id = t.user_id WHERE u.user_name = ?");
        $statement->execute(array($user->getUsername()));
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /*Georgi -- 23.03.2018 -- Търси конкретен юзър по име*/
    public function getUserInfoByName(User $user){
        $statement = $this->pdo->prepare("SELECT user_id, user_name, user_email, user_date, user_pic, user_cover, user_city, user_description FROM users WHERE user_name = ?");
        $statement->execute(array($user->getUsername()));
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /*Georgi -- 23.03.2018 -- Ъпдейтва профила*/
    public function updateUser(User $user){
        $statement = $this->pdo->prepare("UPDATE users SET user_name = ?,user_email = ?,user_pass = ?,user_pic = ?,user_cover = ?, user_city = ?, user_description = ? WHERE user_id = ?");
        $statement->execute(array($user->getUsername(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getImageUrl(),
            $user->getCoverUrl(),
            $user->getCity(),
            $user->getDescription(),
            $user->getId()
        ));
    }

    /*Взима инфо за юзъра по ID*/
    public function getUserInfoById(User $user){
        $statement = $this->pdo->prepare("SELECT user_id, user_name, user_email, user_date, user_pic, user_cover, user_city, user_description FROM users WHERE user_id = ?");
        $statement->execute(array($user->getId()));
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /*Намира следените от дадения потребител юзъри по ID*/
    public function findFollowers(User $user){
        $statement = $this->pdo->prepare("SELECT u.user_name, u.user_pic, u.user_cover FROM users as u JOIN following as f ON u.user_id = f.user_id WHERE f.following_id = ?");
        $statement->execute(array($user->getId()));
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /*Georgi -- 23.03.2018 -- Намира ID на юзър по име*/
    public function findId($name){
        $statement = $this->pdo->prepare("SELECT user_id FROM users WHERE user_name = ?");
        $statement->execute(array($name));
        $result = $statement->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

   public function isFollow($myid, $id){
        $statement = $this->pdo->prepare("SELECT * FROM following WHERE user_id = ? AND following_id = ?");
        $statement->execute(array($myid,$id));
        $result = $statement->rowCount();
        return $result;
    }

    /*Взима following ID*/
    public function getFollowersId($user_id){
        $statement = $this->pdo->prepare("SELECT following_id from mydb.following WHERE user_id = ?");
        $statement->execute(array($user_id));
        $result = $statement->fetchAll(\PDO::FETCH_COLUMN);
        return $result;
    }

    /*Отхаресва потребител*/
    public function dislikeIt($me,$you){
        $statement = $this->pdo->prepare("DELETE FROM following WHERE user_id = ? AND following_id = ?");
        $statement->execute(array($me,$you));
        $result = $statement->rowCount();
        return $result;
    }

    /*Харесва потребител*/
    public function likeIt($me,$you){
        $statement = $this->pdo->prepare("INSERT INTO following (user_id,following_id) VALUES (?,?)");
        $statement->execute(array($me,$you));
        $result = $statement->rowCount();
        return $result;
    }

    /*Намира следващите дадения потребител юзъри по ID*/
    public function findFollowing($id)
    {
        $statement = $this->pdo->prepare("SELECT u.user_name, u.user_pic, u.user_cover, u.user_city, u.user_description FROM users as u JOIN following as f ON u.user_id = f.following_id WHERE f.user_id = ?");
        $statement->execute(array($id));
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /*Избира произволни 3 юзъра*/
    public function getFourRandomUsers($email){
        $statement = $this->pdo->prepare("SELECT user_name, user_pic FROM users  WHERE user_id < (SELECT COUNT(*) FROM users) AND NOT user_email = ?  ORDER BY RAND()  LIMIT 3 ");
        $statement->execute(array($email));
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}