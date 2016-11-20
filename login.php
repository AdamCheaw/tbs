<?php
session_start();
require("connMysql.php");
$token = $_GET['token'];
function checkInput($value){
	if(get_magic_quotes_gpc()){
		$value = stripslashes($value);
	}
	if(!is_numeric($value)){
	  $value = mysql_real_escape_string($value);
	}
	return $value;
}

$email = mysqli_real_escape_string($db_conn,$_POST['email']);
$password = mysqli_real_escape_string($db_conn,$_POST['password']);
$sql_query = "select * from user_list where email ='".$email."'";
$result = mysqli_query($db_conn,$sql_query);
$row = mysqli_fetch_array($result);
if($row["email"] == $email && $row["password"] == $password){
	if($row["status"] == 'unActive'){
		$_SESSION["unActive"] =1;
		header("Location: login_page_ss.php");
	}else{
		$_SESSION['login'] =1;
		$_SESSION['user_id'] = $row["uid"];
		if($token == 1){
			header("Location: demand.php");
		}else{
			echo "<script>";
			echo "history.go(-1)";
			echo "</script>";
		}
	}
}else{
	$_SESSION['unLogin'] =1;
	header("Location: login_page_ss.php");
}

?>