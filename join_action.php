<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");

include "common.php";

$id = $conn->real_escape_string($_POST["id"]);
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$name = $conn->real_escape_string($_POST['name']);
$address = $conn->real_escape_string($_POST['address']);

if(empty($id) || empty($password1) || empty($password2) || empty($name) || empty($address)){
    echo "<script>alert('빈칸이 존재 합니다.');history.back();</script>";
    exit;
}

if($password1 != $password2){
    echo "<script>alert('패스워드가 일치하지 않습니다.');history.back(-1);</script>";
    exit;
}

$id_check = "select * from user where id = '$id'";
$result_check = $conn->query($id_check);

if(mysqli_num_rows($result_check) > 0){
    echo "<script>alert('이미 존재하는 아이디입니다.');history.back(-1);</script>";
    exit;
}

if(!preg_match("/^[0-9a-zA-Z]*$/",($id.$name.$address))){
    echo "<script>alert('문자와 숫자만 사용 가능 합니다.');history.back(-1);</script>";
    exit;
}

$password_hash = hash('sha256', $password1);
$query = "insert into user (id, password, name, address) values ('$id', '$password_hash', '$name', '$address')";
$result = $conn->query($query);

if($result){
    echo "<script>alert('회원가입에 성공하였습니다.');location.href='index.html';</script>";
    exit;
} else {
    echo "<script>alert('회원가입에 실패하였습니다.');history.back(-1);</script>";
    exit;
}

$conn->close();
?>
