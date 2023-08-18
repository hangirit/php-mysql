<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: ../index.html");
    exit();
}
unset($_SESSION["id"]);
session_destroy();

echo "<script>location.href=' ../index.html'</script>";
exit();
?>