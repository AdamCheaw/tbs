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

$provider = $_SESSION['user_id'];
$type = "goods";
$type2 = mysqli_real_escape_string($db_conn,$_POST['type2']);
$name = mysqli_real_escape_string($db_conn,$_POST['name']);
$description = mysqli_real_escape_string($db_conn,$_POST['description']);
$brand = mysqli_real_escape_string($db_conn,$_POST['brand']);
if($brand == ""){
	$brand = "無";
}
$price = mysqli_real_escape_string($db_conn,$_POST['price']);
$quantity = mysqli_real_escape_string($db_conn,$_POST['quantity']);
$rt_quantity = $quantity;
/*if(!empty($_POST['transaction'])){
	$trans_new = "";
	foreach($_POST['transaction'] as $trans){
		$trans_new .= $trans." ";
	}
}*/
//$trans_oth = mysqli_real_escape_string($db_conn,$_POST['trans_oth']);
//$trans_oth_new = $trans_new.$trans_oth;
//$once_time = mysqli_real_escape_string($db_conn,$_POST['once_time']);
$damaged_part = mysqli_real_escape_string($db_conn,$_POST['damaged_part']);
if($damaged_part == ""){
	$damaged_part = "無";
}
$fitting = mysqli_real_escape_string($db_conn,$_POST['fitting']);
$fitting_yes = mysqli_real_escape_string($db_conn,$_POST['fitting_yes']);
$fitting_new = $fitting.' '.$fitting_yes;
$add_purchase = mysqli_real_escape_string($db_conn,$_POST['add_purchase']);
if($add_purchase == ""){
	$add_purchase = "無";
}
/*$advise = mysqli_real_escape_string($db_conn,$_POST['advise']);
$advise_yes = mysqli_real_escape_string($db_conn,$_POST['advise_yes']);
$advise_new = $advise.' '.$advise_yes; */
//$keyword = mysqli_real_escape_string($db_conn,$_POST['keyword']);
	//取得上傳檔案資訊
	$f_name = $_FILES['image']['name'];
    $f_tmp_name = $_FILES['image']['tmp_name'];
    $f_type = $_FILES['image']['type'];
    $f_size = $_FILES['image']['size'];

    if($f_size > 0){
		if(file_exists("uploadfile/".$f_name)){
			$file = explode(".",$f_name);
			$file2 = explode("/",$f_type);
			$f_new_name = $file[0]."-".date("ymdhis")."-".rand(0,10).".".$file2[1];
			echo "<br/>檔名重複，修改新檔名為：".$f_new_name."<br/>圖檔上傳成功<br/>";
			move_uploaded_file($f_tmp_name,"uploadfile/".$f_new_name);
			$image = 'uploadfile/'.$f_new_name;
		}else{
			move_uploaded_file($f_tmp_name,"uploadfile/".$f_name);
			echo "圖片上傳成功<br/>";
			$image = 'uploadfile/'.$f_name;
		}
	}else{
		$image = 'uploadfile/itemicon.png';	
	}
date_default_timezone_set('Asia/Taipei');
$post_date = date("Y-m-d H:i:s");

if($name){
	$sql = "insert into supply_goods_list(type, type2, name, description, price, quantity, rt_quantity,  brand, damaged_part, fitting, add_purchase, image, post_date, provider) values ('$type', '$type2', '$name', '$description', '$price', '$quantity', '$rt_quantity', '$brand', '$damaged_part', '$fitting_new', '$add_purchase', '$image', '$post_date', '$provider')";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
	
	$sql_query = "select * from supply_goods_list where provider='".$provider."' and post_date='".$post_date."';";
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
	header("Location:demand_goods_detail.php?id=$id");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>TbS</title>
	<link rel="shortcut icon" href="img/favicon.ico" />
	<link href="css/trade.css" rel="stylesheet" type="text/css"/>
    <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
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