<?php
$db_host = 'localhost';

$db_name = 'bidding';
$db_user = 'root';
$db_pass = '';

// connect
try {
    // If you change db server system, change this too!
    $connect = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user,$db_pass );
    $connect->exec("set names utf8mb4");
    echo "Connected to database";
}
catch (PDOException $e) {
    echo $e->getMessage();
}