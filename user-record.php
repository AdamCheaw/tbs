<?php
session_start();
include("connMysql.php");
if(isset ($_SESSION['user_id'])){
	$sql_query = "select * from user_list where uid='".$_SESSION['user_id']."';";
	$result = mysqli_query($db_conn,$sql_query);
	$row = mysqli_fetch_array($result);
	$nickname = $row['nickname'];
}
?>
<html lang="ja">
<head>
	<meta charset="utf-8" />
	<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
	<title>TbS</title>
	<link rel="shortcut icon" href="img/favicon.ico" />
	<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
	<link rel="stylesheet" type="text/css" href="user/css/demo.css" />
	<link rel="stylesheet" type="text/css" href="user/css/style2.css" />
	
	<script type="text/javascript"></script>
	<link rel="stylesheet" href="css/user-edit.css" type="text/css" />
	<link rel="stylesheet" href="css/animate.min.css"/> <!-- 动画效果 -->
	<link rel="stylesheet" href="hdialog/css/common.css"/><!-- 页面基本样式 -->
	<link type="text/css" rel="stylesheet" href="css/jquery.toast.css"><!--alert的效果-->
    <link rel="stylesheet" href="css/style-tabPanel.css">
    <script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
    <link href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="js/star-rating.js" type="text/javascript"></script>
	
	<link rel="shortcut icon" href="favicon.ico"> <link href="bootstrap/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="bootstrap/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="bootstrap/css/animate.css" rel="stylesheet">
    <link href="bootstrap/css/style.css?v=4.1.0" rel="stylesheet">
	<style type="text/css">
		.a{font-family:Microsoft JhengHei;}
		.contact{font-size:10pt;}
		.title{font-size:11pt;}
		.name{color:#404040;font-weight:550;font-size:12pt;}
		.need_num{font-size:10pt;padding-left:0px;color:#404040;}
		.date{color : #737373;font-size:10pt;}
		.g1{background-color:#59b300;}
		.g2{background-color:#336600;}
		
		#menu h1
		{
			font-size: 30px;
			font-weight: 600;
			text-transform: uppercase;
			color: rgba(255,255,255,0.9);
			text-shadow: 0px 1px 1px rgba(0,0,0,0.3);
			line-height:55px;
			padding: 20px;
			background: #527a7a;
			border-radius:3px;
		}
	</style>
</head>
<body class="gray-bg">
	<div id="wrapper" >
		<?php 
			if(!isset($_SESSION['user_id'])){
				require ("login_page.php");
			}else{
				echo "<div id='header'>";
				echo "<div id='headerTopicContainer'></div>";
        		require ("header_login.php");
				echo "</div>";
			}
		?>
		
		
		
		<!-- tradeRecord -->
		<div id="tradeRecord" class="panel gray-bg" >
			<div class="content">
				
				<div class="wrapper wrapper-content">
					<div class="col-sm-8">
                <div class="ibox">
                    <div class="ibox-content">
                        <span class="text-muted small pull-right">最后更新：<i class="fa fa-clock-o"></i> 2015-09-01 12:00</span>
                        <h3 class="a">交易記錄確認</h3>
                        <p class="a">
                            所有提供者必须點選確認才能進行下一步交易
                        </p>
                        
                        <div class="clients-list">
                            <ul class="nav nav-tabs">
                                
                                <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-archive"></i> 物品</a>
                                </li>
								<li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i> 服務</a>
                                </li>
								<li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-car"></i> 共乘</a>
                                </li>
								<li class=""><a data-toggle="tab" href="#tab-4"><i class="fa fa-home"></i> 空間</a>
                                </li>
                                <li class=""><a data-toggle="tab" href="#tab-5"><i class="fa fa-briefcase"></i> 您的需求</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
													<?php
														$sql_qy1 = "select * from user_trade a LEFT OUTER JOIN supply_list b on a.product_id = b.sl_id";
														$rs_qy1 = mysqli_query($db_conn,$sql_qy1);
														while($row_qy1 = mysqli_fetch_array($rs_qy1)){
															if($row_qy1['s_type'] == 'goods'){
																$sql_qy2 = "select * from supply_goods_list where id = '".$row_qy1['s_id']."' and provider = '".$_SESSION['user_id']."' ";
																$rs_qy2 = mysqli_query($db_conn,$sql_qy2);
																while($row_qy2 = mysqli_fetch_array($rs_qy2))
																{
																	
																	$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
																	$rs_rqID = mysqli_query($db_conn,$sql_rqID);
																	$row_rqID = mysqli_fetch_array($rs_rqID);
																	echo "<tr>";
																	echo "<td class='client-avatar'><img alt='image' src='".$row_rqID['picture']."'> </td>";
																	echo "<td ><a data-toggle='tab' href='' class='name'>".$row_rqID['nickname']."</a></td>";
																	echo "<td class='title'><a href='supply_goods_detail2.php?id=".$row_qy2['id']."' target='_blank'>".$row_qy2['name']."</a> <span class='need_num'>需要".$row_qy1['need_num']."個</span></td>";
																	
																	if($row_qy1['provider_confirm'] == 'no'){
																		
																		echo "<td><button type='button' class='btn btn-info'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=confirm&type=goods' style='color:white;'>提供？</a></button>
																			  <button type='button' class='btn btn-danger'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=cancel&type=goods' style='color:white;'>不提供？</a></button></td>";
																		
																		echo '<td class="client-status"><span class="label label-g1">未確認</span></td>';
																	}else if($row_qy1['provider_confirm'] == 'yes'){
																		echo "<td class='contact'><i class='fa fa-phone contact-type'></i> ".$row_rqID['phone']." </td>";
																		//<i class="fa fa-envelope">
																		echo '<td class="client-status"><span class="label label-g2">已確認</span></td>';
																	}
																	
																	echo "<td><i class='fa fa-remove contact-type'></i></td></tr>";																	
																}
															}
															
														}
													?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
								<div id="tab-2" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
													<?php
														$sql_qy1 = "select * from user_trade a LEFT OUTER JOIN supply_list b on a.product_id = b.sl_id";
														$rs_qy1 = mysqli_query($db_conn,$sql_qy1);
														while($row_qy1 = mysqli_fetch_array($rs_qy1)){
															if($row_qy1['s_type'] == 'service'){
																$sql_qy2 = "select * from supply_service_list where id = '".$row_qy1['s_id']."' and provider = '".$_SESSION['user_id']."' ";
																$rs_qy2 = mysqli_query($db_conn,$sql_qy2);
																while($row_qy2 = mysqli_fetch_array($rs_qy2))
																{
																	
																	$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
																	$rs_rqID = mysqli_query($db_conn,$sql_rqID);
																	$row_rqID = mysqli_fetch_array($rs_rqID);
																	echo "<tr>";
																	echo "<td class='client-avatar'><img alt='image' src='".$row_rqID['picture']."'> </td>";
																	echo "<td ><a data-toggle='tab' href='' class='name'>".$row_rqID['nickname']."</a></td>";
																	echo "<td class='title'><a href='supply_service_detail2.php?id=".$row_qy2['id']."' target='_blank'>".$row_qy2['name']."</a> </td>";
																	
																	if($row_qy1['provider_confirm'] == 'no'){
																		
																		echo "<td><button type='button' class='btn btn-info'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=confirm&type=service' style='color:white;'>提供？</a></button>
																			  <button type='button' class='btn btn-danger'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=cancel&type=service' style='color:white;'>不提供？</a></button></td>";
																		
																		echo '<td class="client-status"><span class="label label-g1">未確認</span></td>';
																	}else if($row_qy1['provider_confirm'] == 'yes'){
																		echo "<td class='contact'><i class='fa fa-phone contact-type'></i> ".$row_rqID['phone']." </td>";
																		//<i class="fa fa-envelope">
																		echo '<td class="client-status"><span class="label label-g2">已確認</span></td>';
																	}																																		                                                                                                                
																	echo "<td><i class='fa fa-remove contact-type'></i></td></tr>";																	
																}
															}
															
														}
													?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
								<div id="tab-3" class="tab-pane ">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
													<?php
														$sql_qy1 = "select * from user_trade a LEFT OUTER JOIN supply_list b on a.product_id = b.sl_id";
														$rs_qy1 = mysqli_query($db_conn,$sql_qy1);
														while($row_qy1 = mysqli_fetch_array($rs_qy1)){
															if($row_qy1['s_type'] == 'vehicle'){
																$sql_qy2 = "select * from supply_vehicle_list where id = '".$row_qy1['s_id']."' and provider = '".$_SESSION['user_id']."' ";
																$rs_qy2 = mysqli_query($db_conn,$sql_qy2);
																while($row_qy2 = mysqli_fetch_array($rs_qy2))
																{
																	
																	$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
																	$rs_rqID = mysqli_query($db_conn,$sql_rqID);
																	$row_rqID = mysqli_fetch_array($rs_rqID);
																	echo "<tr>";
																	echo "<td class='client-avatar'><img alt='image' src='".$row_rqID['picture']."'> </td>";
																	echo "<td ><a data-toggle='tab' href='' class='name'>".$row_rqID['nickname']."</a></td>";
																	echo "<td class='title'><a href='supply_vehicle_detail2.php?id=".$row_qy2['id']."' target='_blank'>".$row_qy2['destination']."</a> <span class='need_num'>".$row_qy1['need_num']."人共乘</span></td>";
																	
																	if($row_qy1['provider_confirm'] == 'no'){
																		
																		echo "<td><button type='button' class='btn btn-info'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=confirm&type=vehicle' style='color:white;'>提供？</a></button>
																			  <button type='button' class='btn btn-danger'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=cancel&type=vehicle' style='color:white;'>不提供？</a></button></td>";
																		
																		echo '<td class="client-status"><span class="label label-g1">未確認</span></td>';
																	}else if($row_qy1['provider_confirm'] == 'yes'){
																		echo "<td class='contact'><i class='fa fa-phone contact-type'></i> ".$row_rqID['phone']." </td>";
																		//<i class="fa fa-envelope">
																		echo '<td class="client-status"><span class="label label-g2">已確認</span></td>';
																	}																																		                                                                                                                
																	echo "<td><i class='fa fa-remove contact-type'></i></td></tr>";																	
																}
															}
															
														}
													?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
								<div id="tab-4" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
													<?php
														$sql_qy1 = "select * from user_trade a LEFT OUTER JOIN supply_list b on a.product_id = b.sl_id";
														$rs_qy1 = mysqli_query($db_conn,$sql_qy1);
														while($row_qy1 = mysqli_fetch_array($rs_qy1)){
															if($row_qy1['s_type'] == 'space'){
																$sql_qy2 = "select * from supply_space_list where id = '".$row_qy1['s_id']."' and provider = '".$_SESSION['user_id']."' ";
																$rs_qy2 = mysqli_query($db_conn,$sql_qy2);
																while($row_qy2 = mysqli_fetch_array($rs_qy2))
																{
																	
																	$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
																	$rs_rqID = mysqli_query($db_conn,$sql_rqID);
																	$row_rqID = mysqli_fetch_array($rs_rqID);
																	echo "<tr>";
																	echo "<td class='client-avatar'><img alt='image' src='".$row_rqID['picture']."'> </td>";
																	echo "<td ><a data-toggle='tab' href='' class='name'>".$row_rqID['nickname']."</a></td>";
																	echo "<td class='title'><a href='supply_space_detail2.php?id=".$row_qy2['id']."' target='_blank'>".$row_qy2['name']."</a> </td>";
																	
																	if($row_qy1['provider_confirm'] == 'no'){
																		
																		echo "<td><button type='button' class='btn btn-info'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=confirm&type=space' style='color:white;'>提供？</a></button>
																			  <button type='button' class='btn btn-danger'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=cancel&type=space' style='color:white;'>不提供？</a></button></td>";
																		
																		echo '<td class="client-status"><span class="label label-g1">未確認</span></td>';
																	}else if($row_qy1['provider_confirm'] == 'yes'){
																		echo "<td class='contact'><i class='fa fa-phone contact-type'></i> ".$row_rqID['phone']." </td>";
																		//<i class="fa fa-envelope">
																		echo '<td class="client-status"><span class="label label-g2">已確認</span></td>';
																	}																																		                                                                                                                
																	echo "<td><i class='fa fa-remove contact-type'></i></td></tr>";																	
																}
															}
															
														}
													?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-5" class="tab-pane">
                                    <div class="full-height-scroll">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <tbody>
													<?php
														$sql_query1 = "select * from user_trade a LEFT OUTER JOIN supply_list b on a.product_id = b.sl_id where requester_id = '".$_SESSION['user_id']."' ";
														$rs_query1 = mysqli_query($db_conn,$sql_query1);
														
														while($row_q1 = mysqli_fetch_array($rs_query1)){
															if($row_q1['s_type'] == 'goods'){
																$sql_query2 = "select * from supply_goods_list where id = '".$row_q1['s_id']."' ";
																$rs_query2 = mysqli_query($db_conn,$sql_query2);
																while($row_q2 = mysqli_fetch_array($rs_query2)){
																	echo "<tr>";
																	$sql_rqID = "select * from user_list where uid ='".$row_q2['provider']."' ";
																	$rs_rqID = mysqli_query($db_conn,$sql_rqID);
																	$row_rqID = mysqli_fetch_array($rs_rqID);
																	echo "<td>物品類</td><td class='title'>您向<span class='name'>".$row_rqID['nickname']."</span>租借 <a href='supply_goods_detail2.php?id=".$row_q2['id']."' target='_black'>".$row_q2['name']."</a> </td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> ".date('m\月d\日',strtotime($row_q1['trade_date']))."</td>";
																	if($row_q1['provider_confirm'] == 'no'){
																		echo "<td><span class='label label-warning'>提供者未確認</span></td>";
																	}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] == 'no' ){
																		echo "<td ><a class=' btn btn-white btn-sm' data-toggle='modal' data-target='#myModal6' onclick='getProUid(".$row_rqID['uid'].",".$row_q1['tid'].")'><i class='fa fa-star'></i> 請評價 </a> <a class='btn btn-white btn-sm'>舉報</a></td>";
																	}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] != 'no' ){
																		echo "<td><span class='label label-success'>已給予評價</span></td>";
																	}
																	
																	
																}	//
															}
															else if($row_q1['s_type'] == 'service'){
																$sql_query2 = "select * from supply_service_list where id = '".$row_q1['s_id']."' ";
																$rs_query2 = mysqli_query($db_conn,$sql_query2);
																while($row_q2 = mysqli_fetch_array($rs_query2)){
																	echo "<tr>";
																	$sql_rqID = "select * from user_list where uid ='".$row_q2['provider']."' ";
																	$rs_rqID = mysqli_query($db_conn,$sql_rqID);
																	$row_rqID = mysqli_fetch_array($rs_rqID);
																	echo "<td>服務類</td><td class='title'>您向<span class='name'>".$row_rqID['nickname']."</span>提出 <a href='supply_service_detail2.php?id=".$row_q2['id']."' target='_black'>".$row_q2['name']."</a> 的需求</td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> ".date('m\月d\日',strtotime($row_q1['trade_date']))."</td>";
																	if($row_q1['provider_confirm'] == 'no'){
																		echo "<td><span class='label label-warning'>提供者未確認</span></td>";
																	}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] == 'no' ){
																		echo "<td ><a class='bounceInRight btn btn-white btn-sm' onclick='getProUid(".$row_rqID['uid'].",".$row_q1['tid'].")'><i class='fa fa-star'></i> 請評價 </a> <a class='btn btn-white btn-sm'>舉報</a></td>";
																	}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] != 'no' ){
																		echo "<td><span class='label label-success'>已給予評價</span></td>";
																	}
																	
																	
																}	//
															}
															else if($row_q1['s_type'] == 'vehicle'){
																$sql_query2 = "select * from supply_vehicle_list where id = '".$row_q1['s_id']."' ";
																$rs_query2 = mysqli_query($db_conn,$sql_query2);
																while($row_q2 = mysqli_fetch_array($rs_query2)){
																	echo "<tr>";
																	$sql_rqID = "select * from user_list where uid ='".$row_q2['provider']."' ";
																	$rs_rqID = mysqli_query($db_conn,$sql_rqID);
																	$row_rqID = mysqli_fetch_array($rs_rqID);
																	echo "<td>共乘類</td><td class='title'>您向<span class='name'>".$row_rqID['nickname']."</span>提出 <a href='supply_vehicle_detail2.php?id=".$row_q2['id']."' target='_black'>".$row_q2['destination']."</a> 的共乘</td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> ".date('m\月d\日',strtotime($row_q1['trade_date']))."</td>";
																	if($row_q1['provider_confirm'] == 'no'){
																		echo "<td><span class='label label-warning'>提供者未確認</span></td>";
																	}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] == 'no' ){
																		echo "<td ><a class='bounceInRight btn btn-white btn-sm' onclick='getProUid(".$row_rqID['uid'].",".$row_q1['tid'].")'><i class='fa fa-star'></i> 請評價 </a> <a class='btn btn-white btn-sm'>舉報</a></td>";
																	}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] != 'no' ){
																		echo "<td><span class='label label-success'>已給予評價</span></td>";
																	}
																	
																	
																}	//
															}
															else if($row_q1['s_type'] == 'space'){
																$sql_query2 = "select * from supply_space_list where id = '".$row_q1['s_id']."' ";
																$rs_query2 = mysqli_query($db_conn,$sql_query2);
																while($row_q2 = mysqli_fetch_array($rs_query2)){
																	echo "<tr>";
																	$sql_rqID = "select * from user_list where uid ='".$row_q2['provider']."' ";
																	$rs_rqID = mysqli_query($db_conn,$sql_rqID);
																	$row_rqID = mysqli_fetch_array($rs_rqID);
																	echo "<td>空間類</td><td class='title'>您向<span class='name'>".$row_rqID['nickname']."</span>租借 <a href='supply_space_detail2.php?id=".$row_q2['id']."' target='_black'>".$row_q2['name']."</a></td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> ".date('m\月d\日',strtotime($row_q1['trade_date']))."</td>";
																	if($row_q1['provider_confirm'] == 'no'){
																		echo "<td><span class='label label-warning'>提供者未確認</span></td>";
																	}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] == 'no' ){
																		echo "<td ><a class='btn btn-white btn-sm' onclick='getProUid(".$row_rqID['uid'].",".$row_q1['tid'].")'><i class='fa fa-star'></i> 請評價 </a> <a class='btn btn-white btn-sm'>舉報</a></td>";
																	}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] != 'no' ){
																		echo "<td><span class='label label-success'>已給予評價</span></td>";
																	}
																	
																	
																}	//
															}
														}
													?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
			<div class="col-sm-4">
				<div class="ibox">
					<div class="" id="ibox-content">

                                <div id="vertical-timeline" class="vertical-container light-timeline">
                                    <div class="vertical-timeline-block">
                                        <div class="vertical-timeline-icon g1">
                                            
                                        </div>

                                        <div class="vertical-timeline-content">
                                            <span class='label label-g1' style="font-size:15pt;">未確認</span>
                                            <p>此狀態表示已有用戶向您提出了需求，正在等待您確認
                                            </p>
                                        </div>
                                    </div>

                                    <div class="vertical-timeline-block">
                                        <div class="vertical-timeline-icon g2">
                                            
                                        </div>

                                        <div class="vertical-timeline-content">
                                            <span class='label label-g2' style="font-size:15pt;">已確認</span>
                                            <p>此狀態表示您以點選提供，且已經與需求者達成交易</p>
                                        </div>
                                    
                                       
                                    </div>

                                    <div class="vertical-timeline-block">
                                        <div class="vertical-timeline-icon label-success">
                                            
                                        </div>

                                        <div class="vertical-timeline-content">
                                            <span class='label label-success' style="font-size:15pt;">已給與評價</span>
                                            <p>此狀態表示你已經對供給方所提供與您的資源進行評價了</p>
                                            
                                        </div>
                                    </div>

                                    <div class="vertical-timeline-block">
                                        <div class="vertical-timeline-icon label-warning">
                                            
                                        </div>

                                        <div class="vertical-timeline-content">
                                            <span class='label label-warning' style="font-size:15pt;">提供者未確認</span>
                                            <p>此狀態表示您點選的需求尚未被提供者確認提供</p>
                                            
                                        </div>
                                    </div>

                                    
                                </div>

                            </div>
				</div>
			</div>
			
				</div><!--testing-->
            	<!--<section id="tabContainer1" class="jQdmtab tabContainer">
                <ul class="controls">
                    <li id="t1_1"><a href="#tab1_1">您的提供 被需要
                    <?php
						$_SESSION['total_trade'] = 0;
						$_SESSION['Pcheck'] = 0;
						$sql_Pcheck = "select * from user_trade where provider_id = '".$_SESSION['user_id']."' and product_id != 'null' ";
						$rs_Pc = mysqli_query($db_conn,$sql_Pcheck);
						while($row_Pc = mysqli_fetch_array($rs_Pc)){
							if($row_Pc['provider_check'] == 'no'){
								$_SESSION['Pcheck']++;
							}
						}
						if($_SESSION['Pcheck'] != 0){
							echo "[".$_SESSION['Pcheck']."]";
							$_SESSION['total_trade'] += $_SESSION['Pcheck'];
							//unset($_SESSION['Pcheck']);
						}
					?>
                    </a></li>
                    <li id="t1_2"><a href="#tab1_2">您的需求 被提供
                    <?php
                    	$_SESSION['Pcheck2'] = 0;
                    	$sql_Pcheck2 = "select * from user_trade where requester_id = '".$_SESSION['user_id']."' and demandList_id != 'null' ";
						$rs_Pc2 = mysqli_query($db_conn,$sql_Pcheck2);
						while($row_Pc2 = mysqli_fetch_array($rs_Pc2)){
							if($row_Pc2['provider_check'] == 'no'){
								$_SESSION['Pcheck2']++;
							}
						}
						if($_SESSION['Pcheck2'] != 0){
							echo "[".$_SESSION['Pcheck2']."]";
							$_SESSION['total_trade'] += $_SESSION['Pcheck2'];
							//unset($_SESSION['Pcheck2']);
						}
					?>
                    </a></li>
                    <li id="t1_3"><a href="#tab1_3">您需要 他人的提供
                    <?php
                    	$_SESSION['Rcheck'] = 0;
                    	$sql_Rcheck = "select * from user_trade where requester_id = '".$_SESSION['user_id']."' and product_id != 'null' ";
						$rs_Rc = mysqli_query($db_conn,$sql_Rcheck);
						while($row_Rc = mysqli_fetch_array($rs_Rc)){
							if($row_Rc['requester_check'] == 'no'){
								$_SESSION['Rcheck']++;
							}
						}
						if($_SESSION['Rcheck'] != 0){
							echo "[".$_SESSION['Rcheck']."]";
							$_SESSION['total_trade'] += $_SESSION['Rcheck'];
							//unset($_SESSION['Rcheck']);
						}
					?>
                    </a></li>
                </ul>
     
                <div class="tabContentsContainer">
                    <article id="tab1_1" class="post">
                    <div class="entry-content clearfix">
                    	<table id="beRequest" border="0">
                        <tr>
                            <th >您的提供</th>
                            <th >需求者</th>
                            <th >所需的數量</th>
                            <th >動作</th>
                        </tr>
						<?php
                            $sql_qy1 = "select * from user_trade a LEFT OUTER JOIN supply_list b on a.product_id = b.sl_id";
                            $rs_qy1 = mysqli_query($db_conn,$sql_qy1);
                            while($row_qy1 = mysqli_fetch_array($rs_qy1)){
                                if($row_qy1['s_type'] == 'goods'){
                                    $sql_qy2 = "select * from supply_goods_list where id = '".$row_qy1['s_id']."' and provider = '".$_SESSION['user_id']."' ";
                                    $rs_qy2 = mysqli_query($db_conn,$sql_qy2);
                                    while($row_qy2 = mysqli_fetch_array($rs_qy2)){
                                        echo "<tr>";
                                        echo "<td><a href='supply_goods_detail.php?id=".$row_qy2['id']."' target='_blank'>".$row_qy2['name']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
										$rs_rqID = mysqli_query($db_conn,$sql_rqID);
										$row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_qy1['requester_id']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
                                        echo "<td>".$row_qy1['need_num']."</td>";
                                        if($row_qy1['provider_confirm'] == 'no'){
											echo "<td><button class='tinBtnyes'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=confirm&type=goods' style='color:white;'><img src='img/checked.png'/ class='sign'>提供</a></button>";
											echo " / ";
											echo "<button class='tinBtnno'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=cancel&type=goods' style='color:white;'><img src='img/wrong.png'/ class='sign'>不提供</a></button></td>";
										}else if($row_qy1['provider_confirm'] == 'yes'){
											echo "<td><img src='img/circle-check.png' class='circle_check'>已完成交易</td>";
										}
                                        echo "</tr>";
                                    }
                                }
                                if($row_qy1['s_type'] == 'service'){
                                    $sql_qy2 = "select * from supply_service_list where id = '".$row_qy1['s_id']."' and provider = '".$_SESSION['user_id']."' ";
                                    $rs_qy2 = mysqli_query($db_conn,$sql_qy2);
                                    while($row_qy2 = mysqli_fetch_array($rs_qy2)){
                                        echo "<tr>";
                                        echo "<td><a href='supply_service_detail.php?id=".$row_qy2['id']."' target='_blank'>".$row_qy2['name']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
										$rs_rqID = mysqli_query($db_conn,$sql_rqID);
										$row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
                                        echo "<td>".$row_qy1['need_num']."</td>";
                                        if($row_qy1['provider_confirm'] == 'no'){
											echo "<td><button class='tinBtnyes'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=confirm&type=service' style='color:white;'><img src='img/checked.png'/ class='sign'>提供</a></button>";
											echo " / ";
											echo "<button class='tinBtnno'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=cancel&type=service' style='color:white;'><img src='img/wrong.png'/ class='sign'>不提供</a></button></td>";
										}else if($row_qy1['provider_confirm'] == 'yes'){
											echo "<td><img src='img/circle-check.png' class='circle_check'>已完成交易</td>";
										}
                                        echo "</tr>";
                                    }
                                }
                                if($row_qy1['s_type'] == 'space'){
                                    $sql_qy2 = "select * from supply_space_list where id = '".$row_qy1['s_id']."' and provider = '".$_SESSION['user_id']."' ";
                                    $rs_qy2 = mysqli_query($db_conn,$sql_qy2);
                                    while($row_qy2 = mysqli_fetch_array($rs_qy2)){
                                        echo "<tr>";
                                        echo "<td><a href='supply_space_detail.php?id=".$row_qy2['id']."' target='_blank'>".$row_qy2['name']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
										$rs_rqID = mysqli_query($db_conn,$sql_rqID);
										$row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
                                        echo "<td>".$row_qy1['need_num']."</td>";
                                        if($row_qy1['provider_confirm'] == 'no'){
											echo "<td><button class='tinBtnyes'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=confirm&type=space' style='color:white;'><img src='img/checked.png'/ class='sign'>提供</a></button>";
											echo " / ";
											echo "<button class='tinBtnno'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=cancel&type=space' style='color:white;'><img src='img/wrong.png'/ class='sign'>不提供</a></button></td>";
										}else if($row_qy1['provider_confirm'] == 'yes'){
											echo "<td><img src='img/circle-check.png' class='circle_check'>已完成交易</td>";
										}
                                        echo "</tr>";
                                    }
                                }if($row_qy1['s_type'] == 'vehicle'){
                                    $sql_qy2 = "select * from supply_vehicle_list where id = '".$row_qy1['s_id']."' and provider = '".$_SESSION['user_id']."' ";
                                    $rs_qy2 = mysqli_query($db_conn,$sql_qy2);
                                    while($row_qy2 = mysqli_fetch_array($rs_qy2)){
                                        echo "<tr>";
                                        echo "<td><a href='supply_vehicle_detail.php?id=".$row_qy2['id']."' target='_blank'>".$row_qy2['destination']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
										$rs_rqID = mysqli_query($db_conn,$sql_rqID);
										$row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
                                       	echo "<td>".$row_qy1['need_num']."</td>";
                                        if($row_qy1['provider_confirm'] == 'no'){
											echo "<td><button class='tinBtnyes'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=confirm&type=vehicle' style='color:white;'><img src='img/checked.png'/ class='sign yes'>提供</a></button>";
											echo " / ";
											echo "<button class='tinBtnno'><a href='provider_confirmDB.php?tid=".$row_qy1['tid']."&id=".$row_qy1['product_id']."&sd=supply&cc=cancel&type=vehicle' style='color:white;'><img src='img/wrong.png'/ class='sign no'>不提供</a></button></td>";
										}else if($row_qy1['provider_confirm'] == 'yes'){
											echo "<td><img src='img/circle-check.png' class='circle_check'>已完成交易</td>";
										}
                                        echo "</tr>";
                                    }
                                }
                            }
							$sql_CPcheck = "update user_trade set provider_check = 'yes' where provider_id = '".$_SESSION['user_id']."' and product_id != 'no' ";
							mysqli_query($db_conn,$sql_CPcheck) or die("MySQL update DATA error");
                        ?>
                        </table>
                    </div>
                	</article>
                    
                	<article id="tab1_2" class="post">
                    <div class="entry-content clearfix">
                        <table id="beProvide">
                        <tr>
                            <th>您的需求</th>
                            <th>提供者</th>
                            <th>狀態</th>
                            <th>動作</th>
                        </tr>
						<?php
                            $sql_demandtrade = "select * from user_trade a LEFT OUTER JOIN demand_list b on a.demandList_id = b.id where b.provider ='".$_SESSION['user_id']."' ";
                            $rs_demandtrade = mysqli_query($db_conn,$sql_demandtrade);
                            while($row_dt = mysqli_fetch_array($rs_demandtrade)){
									echo "<tr>";
									if($row_dt['type'] == 'goods'){
										echo "<td><a href='demand_goods_detail.php?id=".$row_dt['id']."' target='_blank'>".$row_dt['name']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_dt['requester_id']."' ";
                                        $rs_rqID = mysqli_query($db_conn,$sql_rqID);
                                        $row_rqID = mysqli_fetch_array($rs_rqID);
                                        echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
										$sql_goodsdetail = "select * from supply_goods_list where name = '".$row_dt['name']."' and provider = '".$row_dt['requester_id']."' ";
										$rs_goodsdetail = mysqli_query($db_conn,$sql_goodsdetail);
                                        $row_gdd = mysqli_fetch_array($rs_goodsdetail);
										echo "<td><a href='supply_goods_detail.php?id=".$row_gdd['id']."' target='_blank'>已被提供</a></td>";
										if($row_dt['provider_confirm'] == 'no'){
											echo "<td><button class='tradeBtn'><a href='provider_confirmDB.php?tid=".$row_dt['tid']."&id=".$row_dt['demandList_id']."&sd=demand'>交易確認</a></button></td>";
										}else if($row_dt['provider_confirm'] == 'yes'){
											echo "<td>交易已確認</td>";
										}
									}else if($row_dt['type'] == 'service'){
										echo "<td><a href='demand_service_detail.php?id=".$row_dt['id']."' target='_blank'>".$row_dt['name']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_dt['requester_id']."' ";
                                        $rs_rqID = mysqli_query($db_conn,$sql_rqID);
                                        $row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
										$sql_servicedetail = "select * from supply_service_list where name = '".$row_dt['name']."' and provider = '".$row_dt['requester_id']."' ";
										$rs_servicedetail = mysqli_query($db_conn,$sql_servicedetail);
                                        $row_svd = mysqli_fetch_array($rs_servicedetail);
										echo "<td><a href='supply_service_detail.php?id=".$row_svd['id']."' target='_blank'>已被提供</a></td>";
										if($row_dt['provider_confirm'] == 'no'){
											echo "<td><button class='tradeBtn'><a href='provider_confirmDB.php?tid=".$row_dt['tid']."&id=".$row_dt['demandList_id']."&sd=demand'>交易確認</a></button></td>";
										}else if($row_dt['provider_confirm'] == 'yes'){
											echo "<td>交易已確認</td>";
										}
									}else if($row_dt['type'] == 'space'){
										echo "<td><a href='demand_space_detail.php?id=".$row_dt['id']."' target='_blank'>".$row_dt['name']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_dt['requester_id']."' ";
                                        $rs_rqID = mysqli_query($db_conn,$sql_rqID);
                                        $row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
										$sql_spacedetail = "select * from supply_space_list where name = '".$row_dt['name']."' and provider = '".$row_dt['requester_id']."' ";
										$rs_spacedetail = mysqli_query($db_conn,$sql_spacedetail);
                                        $row_spd = mysqli_fetch_array($rs_spacedetail);
										echo "<td><a href='supply_space_detail.php?id=".$row_spd['id']."' target='_blank'>已被提供</a></td>";
										if($row_dt['provider_confirm'] == 'no'){	
											echo "<td><button class='tradeBtn'><a href='provider_confirmDB.php?tid=".$row_dt['tid']."&id=".$row_dt['demandList_id']."&sd=demand'>交易確認</a></button></td>";
										}else if($row_dt['provider_confirm'] == 'yes'){
											echo "<td>交易已確認</td>";
										}
									}else if($row_dt['type'] == 'vehicle'){
										echo "<td><a href='demand_vehicle_detail.php?id=".$row_dt['id']."' target='_blank'>".$row_dt['destination']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_dt['requester_id']."' ";
                                        $rs_rqID = mysqli_query($db_conn,$sql_rqID);
                                        $row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
										$sql_vehicledetail = "select * from supply_vehicle_list where destination = '".$row_dt['destination']."' and provider = '".$row_dt['requester_id']."' ";
										$rs_vehicledetail = mysqli_query($db_conn,$sql_vehicledetail);
                                        $row_vhd = mysqli_fetch_array($rs_vehicledetail);
										echo "<td><a href='supply_vehicle_detail.php?id=".$row_vhd['id']."' target='_blank'>已被提供</a></td>";
										if($row_dt['provider_confirm'] == 'no'){
											echo "<td><button class='tradeBtn'><a href='provider_confirmDB.php?tid=".$row_dt['tid']."&id=".$row_dt['demandList_id']."&sd=demand'>交易確認</a></button></td>";
										}else if($row_dt['provider_confirm'] == 'yes'){
											echo "<td>交易已確認</td>";
										}
									}
								echo "</tr>";
                           	}
							$sql_CPcheck2 = "update user_trade set provider_check = 'yes' where requester_id = '".$_SESSION['user_id']."' and demandList_id != 'no' ";
							mysqli_query($db_conn,$sql_CPcheck2) or die("MySQL update DATA error");
                        ?>
						</table>
                    </div>
                    </article>
                    
                    <article id="tab1_3" class="post">
                    <div class="entry-content clearfix">
                        <table id="myWanted">
                        <tr>
                            <th>您的需求</th>
                            <th>提供者</th>
                            <th>動作</th>
                        </tr>
						<?php
                            $sql_query1 = "select * from user_trade a LEFT OUTER JOIN supply_list b on a.product_id = b.sl_id where requester_id = '".$_SESSION['user_id']."' ";
                            $rs_query1 = mysqli_query($db_conn,$sql_query1);
                            while($row_q1 = mysqli_fetch_array($rs_query1)){
                                if($row_q1['s_type'] == 'goods'){
                                    $sql_query2 = "select * from supply_goods_list where id = '".$row_q1['s_id']."' ";
                                    $rs_query2 = mysqli_query($db_conn,$sql_query2);
                                    while($row_q2 = mysqli_fetch_array($rs_query2)){
                                        echo "<tr>";
                                        echo "<td><a href='supply_goods_detail2.php?id=".$row_q2['id']."' target='_black'>".$row_q2['name']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_q2['provider']."' ";
										$rs_rqID = mysqli_query($db_conn,$sql_rqID);
										$row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
										if($row_q1['provider_confirm'] == 'no'){
											echo "<td>提供者未確認</td>";
										}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] == 'no' ){
	                                        echo "<td><a class='bounceInRight' onclick='getProUid(".$row_rqID['uid'].",".$row_q1['tid'].")'><img src='img/star2.png' class='rated'/>評價</a></td>";
										}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] != 'no' ){
											echo "<td>已給予評價</td>";
										}
                                        echo "</tr>";
                                    }
                                }
                                if($row_q1['s_type'] == 'service'){
                                    $sql_query2 = "select * from supply_service_list where id = '".$row_q1['s_id']."' ";
                                    $rs_query2 = mysqli_query($db_conn,$sql_query2);
                                    while($row_q2 = mysqli_fetch_array($rs_query2)){
                                        echo "<tr>";
                                        echo "<td><a href='supply_service_detail2.php?id=".$row_q2['id']."' target='_black'>".$row_q2['name']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_q2['provider']."' ";
										$rs_rqID = mysqli_query($db_conn,$sql_rqID);
										$row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
                                        if($row_q1['provider_confirm'] == 'no'){
											echo "<td>提供者未確認</td>";
										}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] == 'no' ){
	                                        echo "<td><a class='bounceInRight' onclick='getProUid(".$row_rqID['uid'].",".$row_q1['tid'].")'><img src='img/star2.png' class='rated'/>評價</a></td>";
										}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] != 'no' ){
											echo "<td>已給予評價</td>";
										}
                                        echo "</tr>";
                                    }
                                }
                                if($row_q1['s_type'] == 'space'){
                                    $sql_query2 = "select * from supply_space_list where id = '".$row_q1['s_id']."' ";
                                    $rs_query2 = mysqli_query($db_conn,$sql_query2);
                                    while($row_q2 = mysqli_fetch_array($rs_query2)){
                                        echo "<tr>";
                                        echo "<td><a href='supply_space_detail2.php?id=".$row_q2['id']."' target='_black'>".$row_q2['name']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_q2['provider']."' ";
										$rs_rqID = mysqli_query($db_conn,$sql_rqID);
										$row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
                                        if($row_q1['provider_confirm'] == 'no'){
											echo "<td>提供者未確認</td>";
										}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] == 'no' ){
	                                        echo "<td><a class='bounceInRight' onclick='getProUid(".$row_rqID['uid'].",".$row_q1['tid'].")'><img src='img/star2.png' class='rated'/>評價</a></td>";
										}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] != 'no' ){
											echo "<td>已給予評價</td>";
										}
                                        echo "</tr>";
                                    }
                                }
                                if($row_q1['s_type'] == 'vehicle'){
                                    $sql_query2 = "select * from supply_vehicle_list where id = '".$row_q1['s_id']."' ";
                                    $rs_query2 = mysqli_query($db_conn,$sql_query2);
                                    while($row_q2 = mysqli_fetch_array($rs_query2)){
                                        echo "<tr>";
                                        echo "<td><a href='supply_vehicle_detail2.php?id=".$row_q2['id']."' target='_black'>".$row_q2['destination']."</a></td>";
										$sql_rqID = "select * from user_list where uid ='".$row_q2['provider']."' ";
										$rs_rqID = mysqli_query($db_conn,$sql_rqID);
										$row_rqID = mysqli_fetch_array($rs_rqID);
										echo "<td><a href='user-profile.php?id=".$row_rqID['uid']."' target='_blank'>".$row_rqID['nickname']."</a></td>";
                                       	if($row_q1['provider_confirm'] == 'no'){
											echo "<td>提供者未確認</td>";
										}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] == 'no' ){
	                                        echo "<td><a class='bounceInRight' onclick='getProUid(".$row_rqID['uid'].",".$row_q1['tid'].")'><img src='img/star2.png' class='rated'/>評價</a></td>";
										}else if($row_q1['provider_confirm'] == 'yes' && $row_q1['requester_score'] != 'no' ){
											echo "<td>已給予評價</td>";
										}
                                        echo "</tr>";
                                    }
                                }
                            }
							$sql_CRcheck = "update user_trade set requester_check = 'yes' where requester_id = '".$_SESSION['user_id']."' and product_id != 'no' ";
							mysqli_query($db_conn,$sql_CRcheck) or die("MySQL update DATA error");
                        ?>
                        </table>
                    </div>
                   	</article>
            	</div>
                </section>-->
			</div>
		</div>
        
		<!-- /tradeRecord -->
		<div id="menu">
			<h1>歡迎您<br/><?php echo $nickname ?>！！</h1>
			<ul id="navigation">
				<li><a id="link-home" href="user-edit.php#home">修改個人資料</a></li>
				<li><a id="link-portfolio" href="user-edit.php#supplyRecord">提供與需求記錄</a></li>
				<!--<li><a id="link-about" href="#demandRecord">需求記錄</a></li>-->
				<li><a id="link-contact" href="#tradeRecord">交易記錄
                <?php
					if($_SESSION['total_trade'] != 0){
	                	echo "[".$_SESSION['total_trade']."]";
						//unset($_SESSION['total_trade']);
					}
				?>
                </a></li>
			</ul>
		</div>
		<div class="modal inmodal fade" id="myModal6" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">窗口标题</h4>
                    </div>
                    <div class="modal-body">
                        <form action="requester_scoringDB.php" method="post">
							<input id="uid" name="uid" type="hidden" value="THE OUTPUT OF GETPROUID FUNCTION">
							<input id="tid" name="tid" type="hidden" value="THE OUTPUT OF GETPROUID FUNCTION">
							<ul class="list">
								<li class="listtext">產品/服務 - 評分</li>
								<li><input id="input-21d" name="scoreProduct" type="number" class="rating" min=0 max=5 step=1 value=5 data-size="md"></li>
								<li class="listtext">提供者 - 評分</li>
								<li><input id="input-21d" name="scoreProvider" type="number" class="rating" min=0 max=5 step=1 value=5 data-size="md"></li>
								<li class="listtext">提供者 - 評語</li>
								<li><textarea name="comment" class="inputTextarea" placeholder="給予產品/服務與提供者評語"></textarea></li>
								<!--<li><input type="submit" value="確認" class="submitBtn"></li>-->
								</ul>
						</form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </div>
        </div>
		<div id="staringBox">
    <script>
	function getProUid(uid, tid){
		document.getElementById('uid').value = uid;
		document.getElementById('tid').value = tid;
	}
	</script>
	<form action="requester_scoringDB.php" method="post">
    	<input id="uid" name="uid" type="hidden" value="THE OUTPUT OF GETPROUID FUNCTION">
        <input id="tid" name="tid" type="hidden" value="THE OUTPUT OF GETPROUID FUNCTION">
    	<ul class="list">
        <li class="listtext">產品/服務 - 評分</li>
        <li><input id="input-21d" name="scoreProduct" type="number" class="rating" min=0 max=5 step=1 value=5 data-size="md"></li>
        <li class="listtext">提供者 - 評分</li>
    	<li><input id="input-21d" name="scoreProvider" type="number" class="rating" min=0 max=5 step=1 value=5 data-size="md"></li>
        <li class="listtext">提供者 - 評語</li>
        <li><textarea name="comment" class="inputTextarea" placeholder="給予產品/服務與提供者評語"></textarea></li>
        <li><input type="submit" value="確認" class="submitBtn"></li>
        </ul>
    </form>
    </div>
	</div>
	
    
	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery.hDialog.min.js"></script>
	<script>
	$(function(){
		var $el = $('.dialog');
		$el.hDialog({'box':'#HBox'});//默认调用
		$el.hDialog({width: 500,height:500});
	});
	$(function(){
		var $el = $('.bounceInRight');
		$el.hDialog({
			box:'#staringBox',//默认调用
			title: '給予評價！',
			width: 450,
			height: 400,
			resetForm: true
		});
	});
	</script>
    <!--<script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>-->
	<script type="text/javascript" src="js/jquery.toast.js"></script>
    <script src="js/script-tabPanel.js"></script>
	<!-- 全局js -->
    <script src="bootstrap/js/jquery.min.js?v=2.1.4"></script>
    <script src="bootstrap/js/bootstrap.min.js?v=3.3.6"></script>

    <script src="bootstrap/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- 自定义js -->
    

    <script>
        $(function () {
            $('.full-height-scroll').slimScroll({
                height: '100%'
            });
        });
    </script>
</body>
</html>