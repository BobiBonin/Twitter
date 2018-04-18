<?php
/**
 * Created by PhpStorm.
 * User: gamig
 * Date: 4/18/2018
 * Time: 12:13 PM
 */

namespace model;


class CommentDao
{
    const DB_NAME = "mydb";
    const DB_IP = "94.26.37.108";
    const DB_PORT = "3306";
    const DB_USER = "gamigata";
    const DB_PASS = "kaish";

    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new \PDO("mysql:host=" . self::DB_IP . ":" . self::DB_PORT . ";dbname=" . self::DB_NAME, self::DB_USER, self::DB_PASS);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo "Problem with db query  - " . $e->getMessage();
        }
    }

    public function addComment(Comment $comment){
        $statement = $this->pdo->prepare("INSERT INTO comments (twat_id, comment_text, owner_id) VALUES (?,?,?)");
        $statement->execute(array($comment->getTweetId(),
            $comment->getContent(),
            $comment->getOwnerId()));
        $result = $statement->rowCount();
        return $result;
    }

    public function showMyComments($id){
        $statement = $this->pdo->prepare("SELECT c.twat_id, c.comment_text, c.comment_date, u.user_pic, u.user_name FROM comments AS c JOIN users AS u ON u.user_id = c.owner_id WHERE c.twat_id = ?");
        $statement->execute(array($id));
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }


}