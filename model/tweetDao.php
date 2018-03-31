<?php

require_once 'dbManager.php';
function addTweet($pdo, $text, $user)
{
    $statement = $pdo->prepare("INSERT INTO twats (user_id,twat_content)  VALUES (?,?)");
    $statement->execute(array($user, $text));
}

function showUserTweets($pdo,$id)
{
    $statement = $pdo->prepare("SELECT twat_content,twat_date,user_id FROM twats WHERE user_id=? ORDER BY twat_date DESC");
    $statement->execute(array($id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode($result));
}
function asd($pdo, $str)
{
    try {
        $statement = $pdo->query("
                                  SELECT users.user_name,users.user_pic ,twats.twat_content, twats.twat_date, twats.user_id 
                                  FROM users,twats 
                                  WHERE ($str) 
                                  AND twats.user_id = users.user_id 
                                  ORDER BY twats.twat_date DESC");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        print_r(json_encode($result));
    } catch (PDOException $e) {
        echo "wtf";
    }
}


/*Georgi*/
function showMyTweets($pdo,$id){
    $statement = $pdo->prepare("SELECT u.user_name, u.user_pic, t.twat_date, t.twat_content FROM twats AS t JOIN users AS u ON u.user_id = t.user_id WHERE u.user_id = ?");
    $statement->execute(array($id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}