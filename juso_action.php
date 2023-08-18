<?php
session_start();
header("Content-Type: text/html; charset=utf-8");

include "common.php";

$address = $conn->real_escape_string($_POST["address"]);

if(strlen($address) > 5) {
    echo "<script>alert('주소는 5글자 이하로 입력해서 검색해주세요.');history.back(-1);</script>";
    exit;
}

if(!preg_match("/^[0-9a-zA-Z]*$/",($address))){
    echo "<script>alert('문자와 숫자만 입력 가능 합니다.');history.back(-1);</script>";
    exit;
}

if (empty($address)) {
    echo "<script>alert('검색어를 입력하세요.');history.back(-1);</script>";
} else {
    $query = "select * from juso where zipcode like '%$address%' or addr1 like '%$address%' or addr2 like '%$address%'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>우편번호</th><th>주소1</th><th>주소2</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            $zipcode = $row['zipcode'];
            $addr1 = $row['addr1'];
            $addr2 = $row['addr2'];
            echo "<tr><td>$zipcode</td><td>$addr1</td><td>$addr2</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<script>alert('검색 결과가 없습니다.');history.back(-1);</script>";
        exit;
    }
}
$conn->close();
?>
