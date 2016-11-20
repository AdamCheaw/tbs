<?php
session_start();
unset($_SESSION['fb_access_token']);
unset($_SESSION['user_id']);
$_SESSION['logout'] =1;
/*echo "<script>";
echo "history.go(-1)";
echo "</script>";*/
header("Location: demand.php");
?>