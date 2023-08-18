<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
include "../common.php";
    
if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit;
}

$bno = $conn->real_escape_string($_GET['idx']);
$username = $conn->real_escape_string($_POST['name']);
$title = $conn->real_escape_string($_POST['title']);
$content = $conn->real_escape_string($_POST['content']);
$sql = mq("select * from board where idx='$bno';");
$board = $sql->fetch_array();
$author = $board['name'];

if ($username !== $author) {
    echo "<script>alert('수정 권한이 없습니다.');history.back(-1);</script>";
    exit;
}

$sql = mq("update board set name='".$username."',title='".$title."',content='".$content."' where idx='".$bno."'"); 
?>

<script type="text/javascript">
    alert("게시글이 수정되었습니다.");
    location.href = "read.php?idx=<?php echo $bno; ?>";
</script>



    