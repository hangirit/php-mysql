<?php
session_start();
include "../common.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit();
}

$username = $_SESSION["id"];
$query = "select * from user where id = '$username'";
$result = mq($query);
$num = mysqli_num_rows($result);

if ($num > 0) {
    $row = mysqli_fetch_assoc($result);

    if (isset($_POST["action"])) {
        $id = xss_html_entity($conn->real_escape_string($_POST["id"]));
        $password = $_POST["password"];
        $password_hash = hash('sha256', $password);
        $name = xss_html_entity($conn->real_escape_string($_POST["name"]));
        $address = xss_html_entity($conn->real_escape_string($_POST["address"]));

        if (!empty($password_hash)) {
            $password_hash = $password_hash;
            $query = "update user set id='$id', password='$password_hash', name='$name', address='$address' where id='$username'";
        } else {
            $query = "update user set id='$id', name='$name', address='$address' where id='$username'";
        }

        $result = mq($query);
        if ($result) {
            echo "<script>alert('회원정보를 수정하였습니다.'); location.href='mypage.php';</script>";
            exit();
        } else {
            echo "<script>alert('회원정보 수정에 실패하였습니다.');</script>";
        }
    }
}
?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>마이페이지</title>
    <link href="../css/mypage.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div id="board_area">
        <h1>마이페이지</h1>
        <?php if ($num > 0) { ?>
        <form action="" method="POST">
            <div class="form-group">
                <label>아이디</label>
                <input type="text" class="form-control" name="id" placeholder="아이디 입력" value="<?php echo $row['id']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>변경할 비밀번호</label>
                <input type="password" class="form-control" name="password" placeholder="변경할 패스워드 입력">
            </div>
            <div class="form-group">
                <label>이름</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="변경할 이름 입력" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="form-group">
                <label>주소</label>
                <input type="text" class="form-control" name="address" placeholder="주소 입력" value="<?php echo $row['address']; ?>" required>
            </div>
            <div class="text-center">
                <input type="button" class="btn btn-info" onclick="location.href='main.php'" value="목록으로">
                <input type="submit" class="btn btn-info" name="action" value="수정하기">
            </div>
        </form>
        <?php } ?>
    </div>
</body>
</html>
