<?php
session_start();
include("connMysql.php");

$tid = (int)$_GET['tid'];
$id = (int)$_GET['id'];
$sd = $_GET['sd'];
if($id){
	if($sd == 'demand'){
		$sql = "update user_trade set provider_confirm = 'yes' where tid='".$tid."' ";
		mysqli_query($db_conn,$sql) or die("MySQL dTrade1 update DATA error");
		
		$sql2 = "update demand_list set d_status = 'down' where id='".$id."' ";
		mysqli_query($db_conn,$sql2) or die("MySQL dTrade2 update DATA error");
		
		$_SESSION['tradeConfirm'] =1;
		echo "<script>history.go(-1)</script>";
	}
	if($sd == 'supply'){
		$cc = $_GET['cc'];
		$type = $_GET['type'];
		
		if($cc == 'confirm'){
			$sql = "update user_trade set provider_confirm = 'yes' where tid='".$tid."' ";
			mysqli_query($db_conn,$sql) or die("MySQL sTrade1 update DATA error");
		
			//$sql2 = "update supply_list set s_status='down' where sl_id='".$id."' ";
			//mysqli_query($db_conn,$sql2) or die("MySQL sTrade2 update DATA error");
			$_SESSION['tradeConfirm'] =1;
			echo "<script>history.go(-1)</script>";
		}else if($cc == 'cancel'){
			if($type == 'space'){
				$sql = "update user_trade set provider_confirm = 'yes' where tid='".$tid."' ";
				mysqli_query($db_conn,$sql) or die("MySQL sTrade1 update DATA error");
			
				$sql2 = "update supply_list set s_status='on' where sl_id='".$id."' ";
				mysqli_query($db_conn,$sql2) or die("MySQL sTrade2 update DATA error");
			}else {
				$sql_ut = "select * from user_trade where tid = '".$tid."' ";
				$rs_ut = mysqli_query($db_conn,$sql_ut);
				$row_ut = mysqli_fetch_array($rs_ut);
				
				
				if($type == 'goods'){
					$sql_sl = "select * from supply_list where s_type='goods' and sl_id='".$id."' ";
					$rs_sl = mysqli_query($db_conn,$sql_sl);
					$row_sl = mysqli_fetch_array($rs_sl);
					
					$sql_query = "select * from supply_goods_list where id='".$row_sl['s_id']."';";
					$result = mysqli_query($db_conn,$sql_query);
					$row = mysqli_fetch_array($result);
					if($row['rt_quantity'] >= 1){
						$new_quantity = $row['rt_quantity'] + $row_ut['need_num'];
						$sql = "update user_trade set provider_confirm = 'yes' where tid='".$tid."' ";
						mysqli_query($db_conn,$sql) or die("MySQL sTrade1 update DATA error");
					
						$sql2 = "update supply_goods_list set rt_quantity='".$new_quantity."' where id='".$row_sl['s_id']."';";
						mysqli_query($db_conn,$sql2) or die("MySQL goods update DATA error");
					}else if($row['rt_quantity'] == 0){
						$new_quantity = $row['rt_quantity'] + $row_ut['need_num'];
						$sql = "update user_trade set provider_confirm = 'yes' where tid='".$tid."' ";
						mysqli_query($db_conn,$sql) or die("MySQL sTrade1 update DATA error");
					
						$sql2 = "update supply_list set s_status='on' where sl_id='".$id."' ";
						mysqli_query($db_conn,$sql2) or die("MySQL goods update DATA error");
						
						$sql3 = "update supply_goods_list set rt_quantity='".$new_quantity."' where id='".$row_sl['s_id']."';";
						mysqli_query($db_conn,$sql3) or die("MySQL goods update DATA error");
					}
				}else if($type == 'service'){
					$sql_sl = "select * from supply_list where s_type='service' and sl_id='".$id."' ";
					$rs_sl = mysqli_query($db_conn,$sql_sl);
					$row_sl = mysqli_fetch_array($rs_sl);
					
					$sql_query = "select * from supply_service_list where id='".$row_sl['s_id']."';";
					$result = mysqli_query($db_conn,$sql_query);
					$row = mysqli_fetch_array($result);
					if($row['rt_quantity'] >= 1){
						$new_quantity = $row['rt_quantity'] + $row_ut['need_num'];
						$sql = "update user_trade set provider_confirm = 'yes' where tid='".$tid."' ";
						mysqli_query($db_conn,$sql) or die("MySQL sTrade1 update DATA error");
					
						$sql2 = "update supply_service_list set rt_quantity='".$new_quantity."' where id='".$row_sl['s_id']."';";
						mysqli_query($db_conn,$sql2) or die("MySQL service update DATA error");	
					}else if($row['rt_quantity'] == 0){
						$new_quantity = $row['rt_quantity'] + $row_ut['need_num'];
						$sql = "update user_trade set provider_confirm = 'yes' where tid='".$tid."' ";
						mysqli_query($db_conn,$sql) or die("MySQL sTrade1 update DATA error");
					
						$sql2 = "update supply_list set s_status='on' where sl_id='".$id."' ";
						mysqli_query($db_conn,$sql2) or die("MySQL service update DATA error");
						
						$sql3 = "update supply_service_list set rt_quantity='".$new_quantity."' where id='".$row_sl['s_id']."';";
						mysqli_query($db_conn,$sql3) or die("MySQL service update DATA error");	
					}
				}else if($type == 'vehicle'){
					$sql_sl = "select * from supply_list where s_type='vehicle' and sl_id='".$id."' ";
					$rs_sl = mysqli_query($db_conn,$sql_sl);
					$row_sl = mysqli_fetch_array($rs_sl);
					
					$sql_query = "select * from supply_vehicle_list where id='".$row_sl['s_id']."';";
					$result = mysqli_query($db_conn,$sql_query);
					$row = mysqli_fetch_array($result);
					if($row['rt_quantity'] >= 1){
						$new_quantity = $row['rt_quantity'] + $row_ut['need_num'];
						$sql = "update user_trade set provider_confirm = 'yes' where tid='".$tid."' ";
						mysqli_query($db_conn,$sql) or die("MySQL sTrade1 update DATA error");
					
						$sql2 = "update supply_vehicle_list set rt_quantity='".$new_quantity."' where id='".$row_sl['s_id']."';";
						mysqli_query($db_conn,$sql2) or die("MySQL vehicle update DATA error");
					}else if($row['rt_quantity'] == 0){
						$new_quantity = $row['rt_quantity'] + $row_ut['need_num'];
						$sql = "update user_trade set provider_confirm = 'yes' where tid='".$tid."' ";
						mysqli_query($db_conn,$sql) or die("MySQL sTrade1 update DATA error");
					
						$sql2 = "update supply_list set s_status='down' where sl_id='".$id."' ";
						mysqli_query($db_conn,$sql2) or die("MySQL service update DATA error");
						
						$sql3 = "update supply_vehicle_list set rt_quantity='".$new_quantity."' where id='".$row_sl['s_id']."';";
						mysqli_query($db_conn,$sql3) or die("MySQL vehicle update DATA error");
					}
				}
			}
		$_SESSION['tradeConfirm'] =1;
		echo "<script>history.go(-1)</script>";
		}
	}
}

?>