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
$type = "vehicle";
$type2 = mysqli_real_escape_string($db_conn,$_POST['type2']);
$provider = $_SESSION['user_id'];
$vehicle_date = mysqli_real_escape_string($db_conn,$_POST['vehicle_date']);
$time = strtotime($vehicle_date);
$vehicle_date_new = date("Y-m-d H:i:s",$time);
$destination = mysqli_real_escape_string($db_conn,$_POST['destination']);
$meet_place = mysqli_real_escape_string($db_conn,$_POST['meet_place']);
$price = mysqli_real_escape_string($db_conn,$_POST['price']);
$num_ppl = mysqli_real_escape_string($db_conn,$_POST['num_ppl']);
$rt_quantity = $num_ppl;
$vehicle_brand = mysqli_real_escape_string($db_conn,$_POST['vehicle_brand']);
$road = mysqli_real_escape_string($db_conn,$_POST['road']);
$mid_getoff = mysqli_real_escape_string($db_conn,$_POST['mid_getoff']);
$mid_yes = mysqli_real_escape_string($db_conn,$_POST['mid_yes']);
$mid_new = $mid_getoff.' '.$mid_yes;
$remind = mysqli_real_escape_string($db_conn,$_POST['remind']);
date_default_timezone_set('Asia/Taipei');
$post_date = date("Y-m-d H:i:s");

if($vehicle_date){
	$sql = "insert into supply_vehicle_list(type, type2, vehicle_date, destination, meet_place, price, num_ppl, rt_quantity, vehicle_brand, road, mid_getoff, remind, post_date, provider) values ('$type', '$type2', '$vehicle_date_new', '$destination', '$meet_place', '$price', '$num_ppl', '$rt_quantity', '$vehicle_brand', '$road', '$mid_new', '$remind', '$post_date', '$provider')";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
	
	$sql_query = "select * from supply_vehicle_list where provider='".$provider."' and post_date='".$post_date."';";
	$result = mysqli_query($db_conn,$sql_query);
	$row = mysqli_fetch_array($result);
	$s_type = $row['type'];
	$s_type2 = $row['type2'];
	$s_id = $row['id'];
	$s_name = $row['destination'];
	$sql_sl = "insert into supply_list(s_type, s_type2, s_id, s_name, s_status) values ('$s_type', '$s_type2', '$s_id', '$s_name', 'on')";
	mysqli_query($db_conn,$sql_sl) or die("MySQL insert_sl DATA error");
	
	$_SESSION['insertDB'] = 1;
	header("Location:supply_apply.php");
}else{
	$_SESSION['noInsertDB'] = 1;
	header("Location:supply_apply.php");
}
?>