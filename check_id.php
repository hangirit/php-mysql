<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");

include "common.php";
$id = $conn->real_escape_string($_POST["id"]);

if(isset($_POST["id"])){
    $id = $_POST["id"];
    $query = "select * from user where id='$id'";
    $result = mysqli_query($conn, $query);

    if(strlen($id) > 7) {
        echo "<script>alert('id는 7글자 이하로 작성해주세요.');history.back(-1);</script>";
        exit;
    }

    if(!preg_match("/^[0-9a-zA-Z]*$/",($id))){
        echo "<script>alert('문자와 숫자만 입력 가능 합니다.');history.back(-1);</script>";
        exit;
    }

    if(!mysqli_num_rows($result) > 0) {
        echo "<script>alert('사용 가능한 아이디 입니다.');history.back(-1);</script>";
        exit;
    } else {
        echo "<script>alert('이미 존재하는 아이디입니다.');history.back(-1);</script>";
        exit;
    }
}

$conn->close();
?>