<?php
	require ("connMysql.php");
	session_start();
	$id=(int)$_POST['id'];//每個list自己的id(不是supply-list的)
	$type = $_POST['type'];
	$provider = $_POST['provider'];
	if($id<=0){
		echo "empty ID";
		exit(0);
	}
	$uid = $_SESSION['user_id'];//需求者的id
	date_default_timezone_set('Asia/Taipei');
	$trade_date = date("Y-m-d H:i:s");
	
	$sql_sl = "select * from supply_list where s_type = '".$type."' and s_id ='".$id."' ";//查詢產品id
	$rs_sl = mysqli_query($db_conn,$sql_sl);
	$row_sl = mysqli_fetch_array($rs_sl);
	$sl_id = $row_sl['sl_id'];
	if($type == "space" )
	{
		
		$sql_ut = "insert into user_trade (product_id, trade_date, provider_id, requester_id, provider_confirm, requester_score, requester_comment, provider_check, requester_check) values ( '$sl_id', '$trade_date', '$provider', '$uid','no','no','no','no','no')";
		mysqli_query($db_conn,$sql_ut) or die("MySQL insert UserTrade DATA error");//記錄這筆交易，等待提供者確認
		
		$sql2 = "update supply_list set s_status='down' where s_type='".$type."' and s_id='".$id."';";//產品下架
		mysqli_query($db_conn,$sql2) or die("MySQL space update DATA error");
	}
	else if($type == "service")
	{
		$sql_ut = "insert into user_trade (product_id, trade_date, provider_id, requester_id, provider_confirm, requester_score, requester_comment, provider_check, requester_check) values ( '$sl_id', '$trade_date', '$provider', '$uid','no','no','no','no','no')";
		mysqli_query($db_conn,$sql_ut) or die("MySQL insert UserTrade DATA error");//記錄這筆交易，等待提供者確認
		
		$sql2 = "update supply_list set s_status='down' where s_type='".$type."' and s_id='".$id."';";//產品下架
		mysqli_query($db_conn,$sql2) or die("MySQL space update DATA error");
	}
	else
	{
		$wanted = (int)$_POST['wanted'];
		if($type == 'goods')
		{
			$sql_query = "select * from supply_goods_list where id='".$id."';";
			$result = mysqli_query($db_conn,$sql_query);
			$row = mysqli_fetch_array($result);
			
			$new_quantity = $row['rt_quantity'] - $wanted;
			$sql = "insert into user_trade (product_id, trade_date, provider_id, requester_id, need_num, provider_confirm, requester_score, requester_comment, provider_check, requester_check) values ( '$sl_id', '$trade_date', '$provider', '$uid', '$wanted','no','no','no','no','no')";
			mysqli_query($db_conn,$sql) or die("MySQL goods insert DATA error line41");
			$sql2 = "update supply_goods_list set rt_quantity='".$new_quantity."' where id='".$id."';";
			mysqli_query($db_conn,$sql2) or die("MySQL goods update DATA error");
			if($new_quantity == 0)
			{
				$sql3 = "update supply_list set s_status='down' where s_type='".$type."' and s_id='".$id."';";
				mysqli_query($db_conn,$sql3) or die("MySQL goods update DATA error");
			}
		}
		else if($type == 'vehicle')
		{
			$sql_query = "select * from supply_vehicle_list where id='".$id."';";
			$result = mysqli_query($db_conn,$sql_query);
			$row = mysqli_fetch_array($result);
			
			$new_quantity = $row['rt_quantity'] - $wanted;
			$sql = "insert into user_trade (product_id, trade_date, provider_id, requester_id, need_num, provider_confirm, requester_score, requester_comment, provider_check, requester_check) values ( '$sl_id', '$trade_date', '$provider', '$uid', '$wanted','no','no','no','no','no')";
			mysqli_query($db_conn,$sql) or die("MySQL vehicle insert DATA error");
			$sql2 = "update supply_vehicle_list set rt_quantity='".$new_quantity."' where id='".$id."';";
			mysqli_query($db_conn,$sql2) or die("MySQL vehicle update DATA error");
			if($new_quantity == 0)
			{
				$sql3 = "update supply_list set s_status='down' where s_type='".$type."' and s_id='".$id."';";
				mysqli_query($db_conn,$sql3) or die("MySQL vehicle update DATA error");
			}
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>TbS</title>
	<link rel="shortcut icon" href="img/favicon.ico" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">  
	<meta name="apple-mobile-web-app-status-bar-style" content="black">  
	<meta content="telephone=no,email=no" name="format-detection">	
	<meta name="author" content="haibao"/>
	<meta name="url" content="http://www.hehaibao.com/"/>
	<link href="css/trade.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
	<!--<link rel="stylesheet" href="hdialog/css/common.css"/><!-- 页面基本样式 
	<link rel="stylesheet" href="hdialog/css/animate.css"/>-->
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
				if($type == 'goods'){
                    $sql = "select * from supply_goods_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				}else if($type == 'service'){
                    $sql = "select * from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				}else if($type == 'space'){
                    $sql = "select * from supply_space_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				}else if($type == 'vehicle'){
                    $sql = "select * from supply_vehicle_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				}
				$result = mysqli_query($db_conn,$sql);
                $row = mysqli_fetch_array($result);
					
             ?>
			 <div id="regSuccess">
                <h1>感謝您使用我們的服務！</h1>
				<ul>
					<li><p>我們已經將您的通訊資料傳給<span id="name"> <?php echo "<a href='user-profile.php?id=".$row['id']."' target='_blank'>".$row['nickname']."</a>";?> </span> </li>
					<li><p>如<?php echo $row["nickname"];?>已確認了您的需求, <?php echo $row["nickname"]  ?>本人將會自行向您聯絡.</li></p>
					<li><p>您可到<a href="user-edit.php#tradeRecord" style="color:#3366cc;">交易記錄</a>确认這筆交易的狀態</p></li>
					<li><p>如果您有任疑問 , 請與我們聯絡 : engage102@gmail.com</p></li>
				</ul>
                
                <div id="thisBtn"><button id="btn"><a href="demand.php">回到首頁</a></button></div>
            </div>
			<!--<div id="trade_confirm">
				<?php
					if($type == 'goods'){
                    	$sql = "select * from supply_goods_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
					}else if($type == 'service'){
                    	$sql = "select * from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
					}else if($type == 'space'){
                    	$sql = "select * from supply_space_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
					}else if($type == 'vehicle'){
                    	$sql = "select * from supply_vehicle_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
					}
                    $result = mysqli_query($db_conn,$sql);
                    $row = mysqli_fetch_array($result);
					$message_demand = mysqli_real_escape_string($db_conn,$_POST['message_demand']);
                ?>
                        <div id="confirm_box">
                            <h1>確認選擇：</h1><hr/>
                            <table id="ThisTable" border="0">
                                <tr>
                                    <th width="30%">您的選擇</th>
                                    <th width="30%">你想對 <?php echo $row['nickname']?> 傳送的訊息</th>
                                    <th width="5%">價格</th>
                                </tr>
                                <tr>
                                    <td style="border:1px solid #d9d9d9;color:#668c99;padding:5px;">
                                        <div id="imgbckcolor"><img id="thisImg" src="<?php echo $row['image'] ?>"></div>
                                        <div id='thisName' >
                                            <?php
                                                if($row['type'] == 'vehicle'){
                                                    echo $row["destination"];
                                                }else{
                                                    echo $row["name"];
                                                }
                                            ?>
                                        </div>
                                    </td>
                                    <form action="<?php echo 'supply_trade_insertdb.php'?>" method="post" >
                                    <td style="text-align:left;vertical-align:top;width:200px;border:1px solid #d9d9d9;padding:5px;" ><?php echo $message_demand ?></td>
                                    <td style="text-align:center;vertical-align:middle;border:1px solid #d9d9d9;padding:5px;font-size:20pt">NT$ <?php echo $row["price"]?></td>
                                </tr>
                                 
                                <tr>
                                    
                                    <td id="thisA" colspan="2" style="border-top:1px dashed black;">
                                        <input type="checkbox" required>
                                        同意我們的<a href="trade_protocol.php" target="_blank">交易協定</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a></input>
                                    </td>
                                    <td style="border-top:1px dashed black;">
										 <input name="message_demand" type="hidden" value="<?php echo $message_demand; ?>">
										 <input name="id" type="hidden" value="<?php echo $id; ?>">
										 <input name="type" type="hidden" value="<?php echo $type; ?>">
                                         <input id='ThisDButton' type="submit" value="確定">
                                    </td>
                                    </form>
                                </tr>
                            </table>
                        </div>
			</div>
		</div>-->
		</div>
		
	
	
	<script src="hdialog/js/jquery-1.9.1.min.js"></script>
	<script src="hdialog/js/jquery.hDialog.min.js"></script>
	<script>
	$(function(){
		var $el = $('.dialog');
		$el.hDialog({'box':'#HBox'});//默认调用
		$el.hDialog({width: 500,height:500,modalHide: false});
		
	});
	</script>
</body>
</html>