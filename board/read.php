<?php
session_start();
include "../common.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit();
}

$loggedInUserId = $_SESSION["id"];
$bno = $_GET['idx'];
$hit = mysqli_fetch_array(mq("select * from board where idx ='".$bno."'"));
$hit = $hit['hit'] + 1;
$fet = mq("update board set hit = '".$hit."' where idx = '".$bno."'");
$sql = mq("select * from board where idx='".$bno."' and (lock_post = '0' or name = '$loggedInUserId')");
$board = $sql->fetch_array();

if ($board['lock_post'] == '1' && $board['name'] !== $loggedInUserId) {
    echo "<script>alert('비밀글에 접근할 수 없습니다.');</script>";
    echo "<script>history.back(-1);</script>";
    exit();
}
?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link href="../css/read.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="board_read">
        <h2><?php echo $board['title']; ?></h2>
        <div id="user_info">
            <?php echo $board['name']; ?> <?php echo $board['date']; ?> 조회:<?php echo $board['hit']; ?>
            <div id="bo_line"></div>
            <div>
                파일 : <a href="../upload/<?php echo $board['file']; ?>" download><?php echo $board['file']; ?></a>
            </div>
        </div>
        <div id="bo_content">
            <?php echo nl2br($board['content']); ?>
        </div>        
        <div id="bo_ser">
            <ul>
                <li><a href="main.php">[목록으로]</a></li>
                <li><a href="modify.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
                <li><a href="delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
