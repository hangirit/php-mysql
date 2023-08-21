<?php
session_start();
include "../common.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit;
}

$file = $_REQUEST["filename"];

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename={$file}");

if(empty($file)) {
    echo "<script>alert('값이 입력되지 않았습니다.');history.back(-1);</script>";
    exit;
}

$upload_path = "../upload/";
$filepath = $upload_path . $file;

if (file_exists($filepath)) {
    readfile($filepath);
} else {
    echo "<script>alert('파일 다운로드에 실패하였습니다.');history.back(-1);</script>";
    exit;
}
?>
