<?php

$host = getenv('DB_HOST');
$user = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$db = getenv('DB_DATABASE');

$conn = mysqli_connect($host, $user, $password, $db);

if(!$conn){
    die("Помилка підключення: " . mysqli_connect_error());
}

?>