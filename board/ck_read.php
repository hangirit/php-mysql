<?php
session_start();
include "../common.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit();
}

$bno = $_GET['idx'];
$sql = mq("select * from board where idx='".$bno."'");
$board = $sql->fetch_array();
?>

<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(function(){
        $("#writepass").dialog({
            modal: true,
            title: '비밀글 입니다.',
            width: 400,
        });
    });
</script>
<div id="writepass">
    <form action="" method="post">
        <p>비밀번호<input type="password" name="pw" /> <input type="submit" value="확인" /></p>
    </form>
</div>
<?php
    $bpw = $board['pw'];

    if (isset($_POST['pw'])) {
        $pwk = $_POST['pw']; 
        if ($pwk === $bpw) {
            echo "<script>location.replace('read.php?idx=".$board['idx']."');</script>";
        } else {
            echo "<script>alert('비밀번호가 틀립니다');</script>";
        }
    }
?>
