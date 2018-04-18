<?php

session_start();

use \model\UserDao;
use \model\User;

function __autoload($class)
{
    $class = "..\\" . $class;
    require_once str_replace("\\", "/", $class) . ".php";
}

if (isset($_POST['btn_edit'])) {
    try {
        $username = htmlentities($_POST['username']);
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
        $city = htmlentities($_POST['city']);
        $description = htmlentities($_POST['description']);
        $url_image = "assets/images/uploads/image_$email.png";
        $url_cover = "assets/images/uploads/cover_$email.png";
        $tmp_image = $_FILES['user_pic']['tmp_name'];
        $tmp_cover = $_FILES["user_cover"]["tmp_name"];

        if (is_uploaded_file($tmp_image)) {
            $url_image = "../view/assets/images/uploads/image_$email.png";
            if (move_uploaded_file($tmp_image, $url_image)) {
                $url_image = "assets/images/uploads/image_$email.png";
            }
        }
        if (is_uploaded_file($tmp_cover)) {
            $url_cover = "../view/assets/images/uploads/cover_$email.png";
            if (move_uploaded_file($tmp_cover, $url_cover)) {
                $url_cover = "assets/images/uploads/cover_$email.png";
            }
        }
        $id = $_SESSION['user']['id'];
        $user = new User($email, sha1($password), $username, $url_image, $url_cover, $city, $description, $id);

        $pdo = new UserDao();
        $pdo->updateUser($user);
        header("location: ../view/profile.php");

    } catch (PDOException $e) {

    }

}
