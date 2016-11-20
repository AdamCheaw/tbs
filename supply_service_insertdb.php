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
$type2 = mysqli_real_escape_string($db_conn,$_POST['type2']);
date_default_timezone_set('Asia/Taipei');
$provider = $_SESSION['user_id'];
$name = mysqli_real_escape_string($db_conn,$_POST['name']);
$price = mysqli_real_escape_string($db_conn,$_POST['price']);
$description = mysqli_real_escape_string($db_conn,$_POST['detail']);
$target = mysqli_real_escape_string($db_conn,$_POST['target']);
$special = mysqli_real_escape_string($db_conn,$_POST['special']);
$service_time = mysqli_real_escape_string($db_conn,$_POST['service_time']);
/*$service_time = mysqli_real_escape_string($db_conn,$_POST['service_time']);
$time = strtotime($service_time);
$ser_time_new = date("Y-m-d H:i:s",$time);
$location = mysqli_real_escape_string($db_conn,$_POST['location']);

$need_skill = mysqli_real_escape_string($db_conn,$_POST['need_skill']);
$special = mysqli_real_escape_string($db_conn,$_POST['special']);
$num_ppl = mysqli_real_escape_string($db_conn,$_POST['num_ppl']);
$rt_quantity = $num_ppl;*/
$post_date = date("Y-m-d H:i:s");

if($name){
	$sql = "insert into supply_service_list(type, type2, name, price, description, post_date, provider, target, special, service_time) values ('$type', '$type2', '$name', '$price', '$description', '$post_date', '$provider', '$target', '$special', '$service_time')";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
	
	$sql_query = "select * from supply_service_list where provider='".$provider."' and post_date='".$post_date."';";
	$result = mysqli_query($db_conn,$sql_query);
	$row = mysqli_fetch_array($result);
	$s_type = $row['type'];
	$s_type2 = $row['type2'];
	$s_id = $row['id'];
	$s_name = $row['name'];
	$sql_sl = "insert into supply_list(s_type, s_type2, s_id, s_name, s_status) values ('$s_type', '$s_type2', '$s_id', '$s_name', 'on')";
	mysqli_query($db_conn,$sql_sl) or die("MySQL insert_sl DATA error");
	
	$_SESSION['insertDB'] = 1;
	header("Location:supply_apply.php");
}else{
	$_SESSION['noInsertDB'] = 1;
	header("Location:supply_apply.php");
}
?>