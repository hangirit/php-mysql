<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
include "../common.php";

if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit();
}
$username = $_POST['name'];
$userpw = $_POST['pw'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d');

if(isset($_POST['lockpost'])){
    $lo_post = '1';
}else{
    $lo_post = '0';
}

$tmpfile = $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];
$filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
$folder = "../upload/".$filename;
move_uploaded_file($tmpfile,$folder);

if ($username && $userpw && $title && $content) {
    $sql = mq("insert into board(name, pw, title, content, date, lock_post, file) values ('$username', '$userpw', '$title', '$content', '$date', '$lo_post', '$o_name')");
    if ($sql) {
        echo "<script>alert('게시글이 작성되었습니다.');location.href='main.php';</script>";
        exit;
    } else {
        echo "<script>alert('게시글 작성에 실패하였습니다.');history.back(-1);</script>";
        exit;
    }
} else {
    echo "<script>alert('입력값을 모두 입력해주세요.');history.back(-1);</script>";
    exit;
}
?>