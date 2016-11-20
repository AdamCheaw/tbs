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

$password = mysqli_real_escape_string($db_conn,$_POST['pass1']);
$password2 = mysqli_real_escape_string($db_conn,$_POST['pass2']);

$sql_query = "select * from user_list where email ='".$_SESSION['rEmail']."'";
$result = mysqli_query($db_conn,$sql_query);
$row = mysqli_fetch_array($result);
if($password != $password2){
	$token = md5($row['uid'].$row['username'].$row['password']);
	$_SESSION['resetPwd'] =1;
	echo '<meta http-equiv=REFRESH CONTENT=0.1;url=forget_pass_reset.php?email='.$row['email'].'&token='.$token.' >';
	//header("Location: forget_pass_reset.php?email='".$row['email']."'&token='".$token."' ");
}
else if($password == $password2){
	$sql = "update user_list set password='$password' where uid='".$row['uid']."'";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
	echo "<script>alert('密碼已重置');</script>";
	header ("Location: demand.php");
}
unset ($_SESSION['rEmail']);
?>