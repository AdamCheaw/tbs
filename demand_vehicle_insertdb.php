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
$provider = $_SESSION['user_id'];
$vehicle_date = mysqli_real_escape_string($db_conn,$_POST['vehicle_date']);
$time = strtotime($vehicle_date);
$date_new = date("Y-m-d",$time);
$vehicle_time = mysqli_real_escape_string($db_conn,$_POST['vehicle_time']);
$time2 = strtotime($vehicle_time);
$time_new = date("H:i:s",$time2);
$destination = mysqli_real_escape_string($db_conn,$_POST['destination']);
$price = mysqli_real_escape_string($db_conn,$_POST['price']);
$description = mysqli_real_escape_string($db_conn,$_POST['description']);
date_default_timezone_set('Asia/Taipei');
$post_date = date("Y-m-d H:i:s");
echo $date_new;
echo $time_new;
if($vehicle_date){ 
	$sql = "insert into demand_list(type, v_date, v_time, destination, price, description, provider, post_date, d_status) values ('$type', '$date_new', '$time_new', '$destination', '$price', '$description', '$provider', '$post_date', 'on');";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
	$_SESSION['insertDB'] = 1;
	header("Location:demand_apply.php");
}else{
	$_SESSION['noInsertDB'] = 1;
	header("Location:demand_apply.php");
}
?>