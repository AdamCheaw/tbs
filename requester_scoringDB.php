<?php
session_start();
include("connMysql.php");

$uid = $_POST['uid'];
$tid = $_POST['tid'];
$scorePd = $_POST['scoreProduct'];
$scorePv = $_POST['scoreProvider'];
$comment = mysqli_real_escape_string($db_conn,$_POST['comment']);
date_default_timezone_set('Asia/Taipei');
$comment_date = date("Y-m-d H:i:s");


$sql_getPvScore = "select * from user_list where uid = '".$uid."' ";
$rs_getPvScore = mysqli_query($db_conn,$sql_getPvScore);
$row_gPvS = mysqli_fetch_array($rs_getPvScore);
$newPvScore = $row_gPvS['score'] + $scorePv ;
$newNumPpl = $row_gPvS['score_num_ppl'] + 1;
 
$sql = "update user_list set score = '".$newPvScore."' where uid = '".$uid."' ";
mysqli_query($db_conn,$sql) or die("MySQL score update DATA error");

$sql1 = "update user_list set score_num_ppl = '".$newNumPpl."' where uid = '".$uid."' ";
mysqli_query($db_conn,$sql1) or die("MySQL score_num_ppl update DATA error");

$sql2 = "update user_trade set requester_score = '".$scorePd."' where tid = '".$tid."' ";
mysqli_query($db_conn,$sql2) or die("MySQL requester_score update DATA error");

$sql3 = "update user_trade set requester_comment = '".$comment."' where tid = '".$tid."' ";
mysqli_query($db_conn,$sql3) or die("MySQL requester_comment update DATA error");

$sql4 = "update user_trade set requester_comment_date = '".$comment_date."' where tid = '".$tid."' ";
mysqli_query($db_conn,$sql4) or die("MySQL requester_comment_date update DATA error");

$_SESSION['Scoring'] =1;
echo "<script>history.go(-1)</script>";
?>