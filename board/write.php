<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");
include "../common.php";

if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit();
}

$username = $_SESSION["id"];
$csrf_token = csrf_token_create();
?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>자유 게시판</title>
    <link href="../css/write.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="board_write">
        <h1>내용을 작성합니다.</h1>
        <div id="write_area">
            <form action="write_ok.php" method="POST" enctype="multipart/form-data">
                <div id="in_title">
                    <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="100" required></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_name">
                    <textarea name="name" id="uname" readonly><?php echo $username; ?></textarea>
                </div>
                <div class="wi_line"></div>
                <div id="in_content">
                    <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
                </div>
                <div id="in_pw">
                    <input type="password" name="pw" id="upw" placeholder="비밀번호" maxlength="100" required />
                </div>
                <div id="in_lock">
                    <input type="checkbox" value="1" name="lockpost" />비밀글로 작성합니다.
                </div>  
                <div id="in_file">
                    <br />
                    <input type="file" value="1" name="b_file" />
                </div>          
                <br />
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                <button type="submit">글 작성</button>
            </form>
        </div>
    </div>
</body>
</html>
