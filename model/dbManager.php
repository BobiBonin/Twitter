<?php

$pdo = null;

const DB_NAME = "mydb";
const DB_IP = "94.26.37.108";
const DB_PORT = "3306";
const DB_USER = "gamigata";
const DB_PASS = "kaish";


try{
    $pdo = new PDO("mysql:host=" . DB_IP . ":" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}catch (Exception $e){
    echo "Problem with db - ". $e->getMessage();
}