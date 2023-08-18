<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
include "../common.php";

if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit();
}

$username = $_SESSION["id"];
$bno = $_GET['idx'];
$sql = mq("select * from board where idx='$bno';");
$board = $sql->fetch_array();
$author = $board['name'];

if ($username !== $author) {
    echo "<script>alert('삭제 권한이 없습니다.');history.back(-1);</script>";
    exit();
}
    
$sql = mq("delete from board where idx='$bno';");
?>

<script type="text/javascript">
    alert("게시글이 삭제되었습니다.");
    location.href = "main.php";
</script>