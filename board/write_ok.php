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
$csrf_token_session = $_SESSION["csrf_token"];
$csrf_token_param = $_REQUEST["csrf_token"];
unset($_SESSION["csrf_token"]);

if(empty($csrf_token_session) && empty($csrf_token_param)) {
        echo "<script>alert('정상적인 접근이 아닙니다.');history.back(-1);</script>";
        exit;
    } else {
    if($csrf_token_param != $csrf_token_session) {
        echo "<script>alert('정상적인 접근이 아닙니다.');history.back(-1);</script>";
        exit;
    }
}

if(isset($_POST['lockpost'])){
    $lo_post = '1';
}else{
    $lo_post = '0';
}

if(!empty($_FILES["file"]["name"])) {
    $o_name = $_FILES["file"]["name"];
    $tmp_name = $_FILES["file"]["tmp_name"];
    $file_info = pathinfo($o_name);
    $file_white_arr = array("png", "jpg", "gif");
    $ext = strtolower($file_info["extension"]);
    
    if (!in_array($ext, $file_white_arr)) {
        echo "<script>alert('png, jpg, gif만 업로드가 가능합니다.');history.back(-1);</script>";
        exit;
    }
    
    $final_filename = hash('sha256', $o_name.time());
    $final_filename .= ".".$ext;
    $finalpath = "../upload/" . $final_filename;

    if (!move_uploaded_file($tmp_name, $finalpath)){
        echo "<script>alert('파일 업로드에 실패하였습니다.');history.back(-1);</script>";
        exit;
    }
}

if ($username && $password_hash && $title && $content) {
    $sql = mq("insert into board(name, pw, title, content, date, lock_post, file) values ('$username', '$password_hash', '$title', '$content', '$date', '$lo_post', '$final_filename')");
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