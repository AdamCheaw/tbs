<?php
	require ("connMysql.php");
	session_start();
	$id=(int)$_POST['id'];//每個list自己的id
	$type = $_POST['type'];
	if($id<=0){
		echo "empty ID";
		exit(0);
	}
	$uid = $_SESSION['user_id'];//需求者的id
	date_default_timezone_set('Asia/Taipei');
	$trade_date = date("Y-m-d H:i:s");
	$message_demand = $_POST['message_demand'];
	
	$sql_sl = "select * from supply_list where s_type = '".$type."' and s_id ='".$id."' ";
	$rs_sl = mysqli_query($db_conn,$sql_sl);
    $row_sl = mysqli_fetch_array($rs_sl);
	$sl_id = $row_sl['sl_id'];
	
	$sql_ut = "insert into user_trade (product_id, trade_date, requester_id, message_demand, provider_confirm, requester_score, provider_check, requester_check) values ( '$sl_id', '$trade_date', '$uid','$message_demand','no','no','no','no')";
	
	mysqli_query($db_conn,$sql_ut) or die("MySQL insert UserTrade DATA error");
/*if($type == 'space'){
	$sql = "insert into user_trade (s_type, supply, trade_date, uid) values ('$type', '$id', '$trade_date', '$uid')";
	mysqli_query($db_conn,$sql) or die("MySQL space insert DATA error");

	$sql2 = "update supply_list set s_status='down' where s_type='".$type."' and s_id='".$id."';";//產品下架
	mysqli_query($db_conn,$sql2) or die("MySQL space update DATA error");
}else {
	$wanted = $_GET['wanted'];
	if($type == 'goods'){
		$sql_query = "select * from supply_goods_list where id='".$id."';";
		$result = mysqli_query($db_conn,$sql_query);
		$row = mysqli_fetch_array($result);
		if($row['rt_quantity'] > 1){
			$new_quantity = $row['rt_quantity'] - 1;
			$sql = "insert into user_trade (s_type, supply, trade_date, uid) values ('$type', '$id', '$trade_date', '$uid')";
			mysqli_query($db_conn,$sql) or die("MySQL goods insert DATA error");
		
			$sql2 = "update supply_goods_list set rt_quantity='".$new_quantity."' where id='".$id."';";
			mysqli_query($db_conn,$sql2) or die("MySQL goods update DATA error");
		}else if($row['rt_quantity'] == 1){
			$new_quantity = $row['rt_quantity'] - 1;
			$sql = "insert into user_trade (s_type, supply, trade_date, uid) values ('$type', '$id', '$trade_date', '$uid')";
			mysqli_query($db_conn,$sql) or die("MySQL goods insert DATA error");
		
			$sql2 = "update supply_list set s_status='down' where s_type='".$type."' and s_id='".$id."';";
			mysqli_query($db_conn,$sql2) or die("MySQL goods update DATA error");
			
			$sql3 = "update supply_goods_list set rt_quantity='".$new_quantity."' where id='".$id."';";
			mysqli_query($db_conn,$sql3) or die("MySQL goods update DATA error");
		}
	}else if($type == 'service'){
		$sql_query = "select * from supply_service_list where id='".$id."';";
		$result = mysqli_query($db_conn,$sql_query);
		$row = mysqli_fetch_array($result);
		if($row['rt_quantity'] > 1){
			$new_quantity = $row['rt_quantity'] - 1;
			$sql = "insert into user_trade (s_type, supply, trade_date, uid) values ('$type', '$id', '$trade_date', '$uid')";
			mysqli_query($db_conn,$sql) or die("MySQL service insert DATA error");
		
			$sql2 = "update supply_service_list set rt_quantity='".$new_quantity."' where id='".$id."';";
			mysqli_query($db_conn,$sql2) or die("MySQL service update DATA error");	
		}else if($row['rt_quantity'] == 1){
			$new_quantity = $row['rt_quantity'] - 1;
			$sql = "insert into user_trade (s_type, supply, trade_date, uid) values ('$type', '$id', '$trade_date', '$uid')";
			mysqli_query($db_conn,$sql) or die("MySQL service insert DATA error");
		
			$sql2 = "update supply_list set s_status='down' where s_type='".$type."' and s_id='".$id."';";
			mysqli_query($db_conn,$sql2) or die("MySQL service update DATA error");
			
			$sql3 = "update supply_service_list set rt_quantity='".$new_quantity."' where id='".$id."';";
			mysqli_query($db_conn,$sql3) or die("MySQL service update DATA error");	
		}
	}else if($type == 'vehicle'){
		$sql_query = "select * from supply_vehicle_list where id='".$id."';";
		$result = mysqli_query($db_conn,$sql_query);
		$row = mysqli_fetch_array($result);
		if($row['rt_quantity'] > 1){
			$new_quantity = $row['rt_quantity'] - 1;
			$sql = "insert into user_trade (s_type, supply, trade_date, uid) values ('$type', '$id', '$trade_date', '$uid')";
			mysqli_query($db_conn,$sql) or die("MySQL vehicle insert DATA error");
		
			$sql2 = "update supply_vehicle_list set rt_quantity='".$new_quantity."' where id='".$id."';";
			mysqli_query($db_conn,$sql2) or die("MySQL vehicle update DATA error");
		}else if($row['rt_quantity'] == 1){
			$new_quantity = $row['rt_quantity'] - 1;
			$sql = "insert into user_trade (s_type, supply, trade_date, uid) values ('$type', '$id', '$trade_date', '$uid')";
			mysqli_query($db_conn,$sql) or die("MySQL vehicle insert DATA error");
		
			$sql2 = "update supply_list set s_status='down' where s_type='".$type."' and s_id='".$id."';";
			mysqli_query($db_conn,$sql2) or die("MySQL vehicle update DATA error");
			
			$sql3 = "update supply_vehicle_list set rt_quantity='".$new_quantity."' where id='".$id."';";
			mysqli_query($db_conn,$sql3) or die("MySQL vehicle update DATA error");
		}
	}
}*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>TbS</title>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <link href="css/register_page.css" rel="stylesheet" type="text/css"/>
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
			<?php
				if($type == 'goods')
				{
                    $sql = "select * from supply_goods_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				}
				else if($type == 'service')
				{
                    $sql = "select * from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				}
				else if($type == 'space')
				{
                    $sql = "select * from supply_space_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				}
				else if($type == 'vehicle')
				{
                    $sql = "select * from supply_vehicle_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				}
                    $result = mysqli_query($db_conn,$sql);
                    $row = mysqli_fetch_array($result);
					//$message_demand = mysqli_real_escape_string($db_conn,$_POST['message_demand']);
              ?>
            <div id="regSuccess">
                <h1>謝謝您使用我們的服務！</h1>
				<ul>
					<li><p>我們已經將您的需求和聯絡資訊告訴<span id="name"> <?php echo "<a href='user-profile.php?id=".$row['id']."' target='_blank'>".$row['nickname']."</a>";?> </span> </li>
					<li><p>如<?php echo $row["nickname"];?>已確認了您的需求, <?php echo $row["nickname"]  ?>本人將會自行向您聯絡.</li></p>
					<li><p>您可到<a href="user-edit.php#tradeRecord" style="color:#3366cc;">交易記錄</a>确认這筆交易的狀態</p></li>
				</ul>
                
                <div id="thisBtn"><button id="btn"><a href="demand.php">回到首頁</a></button></div>
            </div>
        </div>
    </div>
</body>
</html>