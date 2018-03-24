<?php
/*Georgi -- 23.03.2018 -- Редактиране на профила
снимката изчезва когато се събмитне празна формата
трябва да се оправи също трябва да се напише проверка
дали снимката вече е била качена и при смяна на снимка
старата да се изтрива
*/
session_start();
require_once "../model/userDao.php";

if (isset($_POST['btn_edit'])) {
    try {
        require_once '../model/dbManager.php';
        $username = htmlentities($_POST['username']);
        $email = htmlentities($_POST['email']);
        $password = htmlentities($_POST['password']);
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
        $id = findId($pdo, $_SESSION['email']);
        updateUser($pdo, $username, $email, sha1($password), $url_image, $url_cover, $id['user_id']);
        header("location: ../view/profile.php");


    } catch (PDOException $e) {

    }

}
