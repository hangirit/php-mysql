<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");

include "common.php";

$id = $conn->real_escape_string($_POST["id"]);
$pw = $_POST["pw"];
$password_hash = hash('sha256', $pw);
$query = "select * from user where id='$id' and password='$password_hash'";
$result = $conn->query($query);

if(strlen($id) > 7) {
    echo "<script>alert('아이디 입력값이 초과 되었습니다.');history.back(-1);</script>";
    exit;
}

if(!preg_match("/^[0-9a-zA-Z]*$/",($id))){
    echo "<script>alert('정상적인 입력값이 아닙니다.');history.back(-1);</script>";
    exit;
}

if (mysqli_num_rows($result)>0){
    $_SESSION["id"] = $id;
    $_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];
    echo "<script>alert('환영 합니다.');location.href='./board/main.php';</script>";
    exit;
}   else {
    echo "<script>alert('회원정보가 맞지 않습니다.');history.back(-1);</script>";
    exit;
}

$conn->close();
?>