<?php
require ("connMysql.php");
session_start();

$id=(int)$_GET['id'];
$provider = $_GET['provider'];
if($id<=0){
	echo "empty ID";
	exit(0);
}
$uid = $_SESSION['user_id'];
date_default_timezone_set('Asia/Taipei');
$trade_date = date("Y-m-d H:i:s");
if($id){
	$sql_ut = "insert into user_trade (demandList_id, trade_date, provider_id, requester_id, provider_confirm, requester_score, requester_comment, provider_check, requester_check) values ('$id', '$trade_date', '$provider', '$uid', 'no', 'no', 'no', 'no', 'no')";
	mysqli_query($db_conn,$sql_ut) or die("MySQL insert DATA error");
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
	
}else{
	$_SESSION['noInsertDB'] = 1;
	header("Location:demand_vehicle_detail.php?id=$id");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>TbS</title>
	<link rel="shortcut icon" href="img/favicon.ico" />
	<link href="css/trade.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="header-inner">
				<div id="logo">
					<a href="demand.php"><img src="img/logo.png" /></a>
				</div>
			</div>
		</div>
		<div id="content">
			<div id="Success">
				謝謝您對於我們的提供！<br/>
				请至您的<a href="user-edit.php#tradeRecord">交易記錄</a>確認！<br/><br/>
				<div id="thisBtn"><a href="demand.php">點我～回到首頁</a></div>
			</div>
		</div>
	</div>
</body>
</html>