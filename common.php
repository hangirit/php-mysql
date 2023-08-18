<?php
session_start();
header("Content-Type: text/html; charset=utf-8");

$servername = "localhost";
$system_user = "root";
$system_pw = "hangirit";
$database = "user";

$conn = new mysqli($servername, $system_user, $system_pw, $database);

mysqli_set_charset($conn, "utf8");

function mq ($sql)
    {
        global $conn;
        return $conn->query($sql);
    }
?>