<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
include "../common.php";

if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit();
}
$username = xss_html_entity($conn->real_escape_string($_POST['name']));
$userpw = $_POST['pw'];
$password_hash = hash('sha256', $userpw);
$title = xss_html_entity($conn->real_escape_string($_POST['title']));
$content = xss_html($conn->real_escape_string($_POST['content']));
$date = xss_html_entity($conn->real_escape_string(date('Y-m-d')));

if(isset($_POST['lockpost'])){
    $lo_post = '1';
}else{
    $lo_post = '0';
}

$tmpfile = $_FILES['b_file']['tmp_name'];
$o_name = xss_html_entity($_FILES['b_file']['name']);
$filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
$folder = "../upload/".$filename;
move_uploaded_file($tmpfile,$folder);

if ($username && $password_hash && $title && $content) {
    $sql = mq("insert into board(name, pw, title, content, date, lock_post, file) values ('$username', '$password_hash', '$title', '$content', '$date', '$lo_post', '$o_name')");
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