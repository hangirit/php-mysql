<?php
session_start();
include "../common.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit();
}

$perPage = 5;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$searchKeyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$searchType = isset($_GET['type']) ? $_GET['type'] : 'title';
$searchQuery = "select * from board";

if (!empty($searchKeyword)) {
    $searchType = $conn->real_escape_string($searchType);
    $searchKeyword = $conn->real_escape_string($searchKeyword);
    if ($searchType == 'title') {
        $searchQuery .= " where title like '%$searchKeyword%'";
    } elseif ($searchType == 'author') {
        $searchQuery .= " where name like '%$searchKeyword%'";
    } elseif ($searchType == 'content') {
        $searchQuery .= " where content like '%$searchKeyword%'";
    }
}

if(!preg_match("/^[0-9a-zA-Z]*$/",($searchKeyword)) || !preg_match("/^[a-zA-Z]*$/",($searchType))) {
    echo "<script>alert('정상적인 입력값이 아닙니다.');history.back(-1);</script>";
    exit;
}

if(strlen($searchType) > 7) {
    echo "<script>alert('제한된 길이를 초과하였습니다.');history.back(-1);</script>";
    exit;
}

if(strlen($searchKeyword) > 7) {
    echo "<script>alert('제한된 길이를 초과하였습니다.');history.back(-1);</script>";
    exit;
}

$totalRows = mysqli_num_rows(mq($searchQuery));
$totalPages = ceil($totalRows / $perPage);
$start = ($currentPage - 1) * $perPage;
$searchQuery .= " order by idx desc limit $start, $perPage";
$sql = mq($searchQuery);
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>메인 페이지</title>
        <link href="../css/main.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div id="board_area">
            <h1>자유 게시판</h1>
            <div class="search-form">
                <form action="" method="GET">
                    <select name="type">
                        <option value="title" <?= ($searchType == "title" ? "selected" : "") ?>>제목</option>
                        <option value="author" <?= ($searchType == "author" ? "selected" : "") ?>>작성자</option>
                        <option value="content" <?= ($searchType == "content" ? "selected" : "") ?>>내용</option>
                    </select>
                    <input type="text" name="keyword" placeholder="검색어 입력" value="<?= $searchKeyword ?>">
                    <button type="submit">검색</button>
                </form>
            </div>
            <table class="list-table">
                <thead>
                    <tr>
                        <th width="70">번호</th>
                        <th width="500">제목</th>
                        <th width="120">글쓴이</th>
                        <th width="100">작성일</th>
                        <th width="100">조회수</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($board = $sql->fetch_array()) : ?>
                    <?php
                    $title = $board["title"];
                    if (strlen($title) > 30) {
                        $title = mb_substr($title, 0, 30, "utf-8") . "...";
                    }

                    $lockImg = "";
                    if ($board['lock_post'] == "1") {
                        $lockImg = "<img src='../img/lock.png' alt='lock' title='lock' width='20' height='20' />";
                        $title = $lockImg . $title;
                    }
                    ?>
                    <tr>
                        <td width="70"><?= $board['idx'] ?></td>
                        <td width="500">
                            <a href="<?= ($board['lock_post'] == "1" ? "ck_read.php?idx=" . $board['idx'] : "read.php?idx=" . $board['idx']) ?>"><?= $title ?></a>
                        </td>
                        <td width="120"><?= $board['name'] ?></td>
                        <td width="100"><?= $board['date'] ?></td>
                        <td width="100"><?= $board['hit'] ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
            <div class="pagination">
                <ul>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li><a class="<?= ($currentPage == $i ? 'active' : '') ?>" href="?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                </ul>
            </div>
            <div id="write_btn">
                <br />
                <a href="write.php"><button>글쓰기</button></a>
            </div>
        </div>
        <p class="greeting"><?= $_SESSION["id"] ?>님 반갑습니다.</p>
        <div class="logout-container">
            <input type="button" onclick="location.href='mypage.php'" value="마이페이지" id="mypage-btn">
            <input type="button" onclick="location.href='logout.php'" value="로그아웃" id="logout-btn">
        </div>
    </body>
</html>
