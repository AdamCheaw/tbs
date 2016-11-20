<?php
session_start();
include("connMysql.php");

$sd = $_GET['sd'];

if($sd == 'demand'){
	$id = $_GET['id'];
	$sql_dl = "update demand_list set d_status = 'on' where id = '".$id."' ";
	mysqli_query($db_conn,$sql_dl) or die("MySQL DL update DATA error");
	
	$_SESSION['reUpload'] =1;
	echo "<script>history.go(-1)</script>";
}
if($sd == 'supply'){
	$s_id = $_GET['s_id'];
	$sl_id = $_GET['sl_id'];
	$type = $_GET['type'];
	
	$sql_sl = "update supply_list set s_status = 'on' where sl_id = '".$sl_id."' ";
	mysqli_query($db_conn,$sql_sl) or die("MySQL SL update DATA error");
	
	if($type == 'goods'){
		$sql = "select * from supply_goods_list where id = '".$s_id."' ";
		$rs = mysqli_query($db_conn,$sql);
		$row = mysqli_fetch_array($rs);
		if($row['rt_quantity'] == 0){
			$sql_qy2 = "update supply_goods_list set rt_quantity = '".$row['quantity']."' where sl_id = '".$sl_id."' ";
			mysqli_query($db_conn,$sql_qy2) or die("MySQL SGL update DATA error");
		}
	}else if($type == 'service'){
		$sql = "select * from supply_service_list where id = '".$s_id."' ";
		$rs = mysqli_query($db_conn,$sql);
		$row = mysqli_fetch_array($rs);
		if($row['rt_quantity'] == 0){
			$sql_qy2 = "update supply_goods_list set rt_quantity = '".$row['num_ppl']."' where sl_id = '".$sl_id."' ";
			mysqli_query($db_conn,$sql_qy2) or die("MySQL SGL update DATA error");
		}
	}else if($type == 'vehicle'){
		$sql = "select * from supply_vehicle_list where id = '".$s_id."' ";
		$rs = mysqli_query($db_conn,$sql);
		$row = mysqli_fetch_array($rs);
		if($row['rt_quantity'] == 0){
			$sql_qy2 = "update supply_goods_list set rt_quantity = '".$row['num_ppl']."' where sl_id = '".$sl_id."' ";
			mysqli_query($db_conn,$sql_qy2) or die("MySQL SGL update DATA error");
		}
	}
	
	$_SESSION['reUpload'] =1;
	echo "<script>history.go(-1)</script>";
}
?>