<?php

require_once 'dbManager.php';
function addTweet($pdo, $text, $user)
{
    $statement = $pdo->prepare("INSERT INTO twats (user_id,twat_content)  VALUES (?,?)");
    $statement->execute(array($user, $text));
}

function showFollowingTweets()
{

}

function showOwnTweets($pdo,$id)
{
    $statement = $pdo->prepare("SELECT twat_content,twat_date,user_id FROM twats WHERE user_id=? ORDER BY twat_date DESC");
    $statement->execute(array($id));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    print_r(json_encode($result));
}
