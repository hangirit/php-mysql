<?php
session_start();
include "../common.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit;
}

$file = $_REQUEST["filename"];
$file = str_replace("\\", "/", $file);

if(strpos($file, "/") !== false || strpos($file, "..") !== false) {
    echo "<script>alert('허용되지 않은 문자가 입력되었습니다.');history.back(-1);</script>";
    exit;
}

if(empty($file)) {
    echo "<script>alert('값이 입력되지 않았습니다.');history.back(-1);</script>";
    exit;
}

$upload_path = "../upload/";
$filepath = $upload_path . $file;

if (file_exists($filepath)) {
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename={$file}");
    readfile($filepath);
} else {
    echo "<script>alert('파일 다운로드에 실패하였습니다.');history.back(-1);</script>";
    exit;
}
?>
