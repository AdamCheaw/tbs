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

$type = "service";
$provider = $_SESSION['user_id'];
$name = mysqli_real_escape_string($db_conn,$_POST['name']);
$price = mysqli_real_escape_string($db_conn,$_POST['price']);
$description = mysqli_real_escape_string($db_conn,$_POST['description']);
date_default_timezone_set('Asia/Taipei');
$post_date = date("Y-m-d H:i:s");
$need_date = mysqli_real_escape_string($db_conn,$_POST['need_date']);
$need_date = strtotime($need_date);
$date_new = date("Y-m-d",$need_date);
if($name){ 
	$sql = "insert into demand_list(type, name, price, description, provider, post_date, d_status, need_date) values ('$type', '$name', '$price', '$description', '$provider', '$post_date', 'on', '$date_new');";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
	$_SESSION['insertDB'] = 1;
	header("Location:demand_apply.php");
}else{
	$_SESSION['noInsertDB'] = 1;
	header("Location:demand_apply.php");
}
?>