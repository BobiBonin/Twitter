<?php
session_start();
if(!isset($_SESSION['user']['email'])){
    header("location:../index.php");
}