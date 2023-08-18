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
    echo "<script>alert('수정 권한이 없습니다.');history.back(-1);</script>";
    exit();
}
?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>자유 게시판</title>
    <link href="../css/modify.css" rel="stylesheet" />
</head>
<body>
    <div id="board_write">
        <h1>내용을 수정합니다.</h1>
        <div id="write_area">
            <form action="modify_ok.php?idx=<?php echo $bno; ?>" method="POST">
                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required><?php echo $board['title']; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_name">
                    <textarea name="name" id="uname" readonly><?php echo $username; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용" required><?php echo $board['content']; ?></textarea> 
                </div>
                <br />
                <div class="bt_se">
                    <button type="submit">글 수정</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
