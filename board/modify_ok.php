<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
include "../common.php";
    
if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit;
}

$bno = $conn->real_escape_string($_GET['idx']);
$username = xss_html_entity($conn->real_escape_string($_POST['name']));
$title = xss_html_entity($conn->real_escape_string($_POST['title']));
$content = xss_html($conn->real_escape_string($_POST['content']));
$sql = mq("select * from board where idx='$bno';");
$board = $sql->fetch_array();
$author = $board['name'];
$csrf_token_session = $_SESSION["csrf_token"];
$csrf_token_param = $_REQUEST["csrf_token"];
unset($_SESSION["csrf_token"]);

if ($username !== $author) {
    echo "<script>alert('수정 권한이 없습니다.');history.back(-1);</script>";
    exit;
}

if(empty($csrf_token_session) && empty($csrf_token_param)) {
        echo "<script>alert('정상적인 접근이 아닙니다.');history.back(-1);</script>";
        exit;
    } else {
    if($csrf_token_param != $csrf_token_session) {
        echo "<script>alert('정상적인 접근이 아닙니다.');history.back(-1);</script>";
        exit;
    }
}

$sql = mq("update board set name='".$username."',title='".$title."',content='".$content."' where idx='".$bno."'"); 
?>

<script type="text/javascript">
    alert("게시글이 수정되었습니다.");
    location.href = "read.php?idx=<?php echo $bno; ?>";
</script>



    