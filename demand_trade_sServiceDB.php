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

$type = "service";
$type2 = mysqli_real_escape_string($db_conn,$_POST['type2']);
date_default_timezone_set('Asia/Taipei');
$provider = $_SESSION['user_id'];
$name = mysqli_real_escape_string($db_conn,$_POST['name']);
$service_time = mysqli_real_escape_string($db_conn,$_POST['service_time']);
$time = strtotime($service_time);
$ser_time_new = date("Y-m-d H:i:s",$time);
$location = mysqli_real_escape_string($db_conn,$_POST['location']);
$price = mysqli_real_escape_string($db_conn,$_POST['price']);
$description = mysqli_real_escape_string($db_conn,$_POST['detail']);
$need_skill = mysqli_real_escape_string($db_conn,$_POST['need_skill']);
$special = mysqli_real_escape_string($db_conn,$_POST['special']);
$num_ppl = mysqli_real_escape_string($db_conn,$_POST['num_ppl']);
$rt_quantity = $num_ppl;
$post_date = date("Y-m-d H:i:s");

if($name){
	$sql = "insert into supply_service_list(type, type2, name, service_time, location, price, description, need_skill, special, num_ppl, rt_quantity, post_date, provider) values ('$type', '$type2', '$name', '$ser_time_new', '$location', '$price', '$description', '$need_skill', '$special', '$num_ppl', '$rt_quantity', '$post_date', '$provider')";
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
	
}else{
	$_SESSION['noInsertDB'] = 1;
	header("Location:demand_service_detail.php?id=$id");
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