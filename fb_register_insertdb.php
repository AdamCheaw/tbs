<?php
require("connMysql.php");
session_start();

function checkInput($value){
	if(get_magic_quotes_gpc()){
		$value = stripslashes($value);
	}
	if(!is_numeric($value)){
	  $value = mysql_real_escape_string($value);
	}
	return $value;
}

$username = mysqli_real_escape_string($db_conn,$_POST['username']);
$nickname = $_SESSION['FBname'];
$phone = mysqli_real_escape_string($db_conn,$_POST['phone']);
$email = mysqli_real_escape_string($db_conn,$_POST['email']);
$birthday = mysqli_real_escape_string($db_conn,$_POST['birthday']);
$gender = $_SESSION['FBgender'];
$picture = $_SESSION['FBpicture'];
$fbuid = $_SESSION['FBuid'];
date_default_timezone_set('Asia/Taipei');
$register_date = date("Y-m-d H:i:s");

if($fbuid){
	$sql = "insert into user_list(username, nickname, phone, email, birthday, gender, picture, FBuid, register_date) values ('$username', '$nickname', '$phone', '$email', '$birthday', '$gender', '$picture', '$fbuid', '$register_date')";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
	$sql_query = "select * from user_list where FBuid ='".$_SESSION['FBuid']."'";
	$result = mysqli_query($db_conn,$sql_query);
	$row = mysqli_fetch_array($result);
	$_SESSION['user_id'] = $row["uid"];
	echo "<script>";
	echo "history.go(-4)";
	echo "</script>";
}
?>