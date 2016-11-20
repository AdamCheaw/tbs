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
	<link rel="stylesheet" href="block-UI/style2.css" type="text/css" />
	<script type="text/javascript"></script>
	<link rel="stylesheet" href="css/user-edit.css" type="text/css" />
	
	<link type="text/css" rel="stylesheet" href="css/jquery.toast.css"><!--alert的效果-->
    <link rel="stylesheet" href="css/style-tabPanel.css">
    <!--<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>-->
    <link rel="shortcut icon" href="favicon.ico"> <link href="bootstrap/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="bootstrap/css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="bootstrap/css/animate.css" rel="stylesheet">
    <link href="bootstrap/css/style.css?v=4.1.0" rel="stylesheet">
	<style type="text/css">
		
		.title{color:gray;font-weight:900;font-family:Microsoft JhengHei;}
		.title2{color:#668099;font-weight:900;font-family:Microsoft JhengHei;}
		.ibox{border:1px solid #d9d9d9;}
		.icon-adjust{font-size:40pt;color:gray;}
		.img-adjust{width:150px;height:100px;}
		.user-pic{width:100%;}
		.tt{background-color:#e6e6e6;border:1px solid #d9d9d9;padding-top:5px;}
		#upload-button{width:100%;font-size:12pt;background-color:#f2f2f2;}
		.name{font-size:16pt;}
		.date{color : #737373;}
		.description{width:250px;font-size:11pt;}
		.col-9{height:120px;vertical-align:top;}
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
	<div id="wrapper">
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
		<!-- Home -->
		<div id="home"  class="panel gray-bg">
		<div class="content">
			<div class="row">
				<div class="wrapper wrapper-content animated fadeInUp">
					<div class="col-sm-12">
						<div class="row">
						<div class="col-sm-4">
							<div class="ibox float-e-margins">
								<div class="ibox-title tt">
									<h3 class="">個人資料相片</h3>
								</div>
								<div class="ibox-content">
								<p>清楚的正面有助用戶之間相互了解 , 請上載可清楚顯示面部的相片</p>
								<form action="update_finish.php" method="post" name="formAdd" id="formAdd" enctype="multipart/form-data">
								<?php
									if($row["picture"] == null){
										echo "<img src='img/selfie.png'/ class='user-pic '>";
									}else{
										echo "<img src='".$row['picture']."' class='user-pic '/>";
									}
								?>
								
								<div class="well">
									
									<div class="button">
										<input type="file" class="inputFile" name="image" id="upload-button" value="請上傳相片">
									</div>
									<div>
										<img class="preview" style="max-width: 150px; max-height:150px">
										<div class="size"></div>
									</div>
								</div>
										
										
										
									
									
								</div>
							</div>
							
						</div>
						<div class="col-sm-7">
							<div class="ibox">
								<div class="ibox-title tt">
									<h3 class="">必填資訊</h3>
								</div>
								<div class="ibox-content">
									<div class="form-horizontal">
										<div class="form-group">
											<label for="nickname" class="col-sm-3 control-label">名字 : </label>

											<div class="col-sm-8">
												<input name="id" type="hidden" value="<?php echo $row["uid"] ?>">
												<input  class="form-control" type="text"  id="nickname" name="nickname" placeholder="名字" value="<?php echo $row["nickname"] ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="birth" class="col-sm-3 control-label">生日 : </label>

											<div class="col-sm-8">
												
												<input  class="form-control" id="birth" type="date" name="birthday" class="col-6" value="<?php echo $row["birthday"] ?>">
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="col-sm-3 control-label">EMAIL : </label>

											<div class="col-sm-8">
												
												<input  class="form-control" type="text" id="email" name="email" placeholder="NCNU EMAIL" required value="<?php echo $row["email"] ?>" >
											</div>
										</div>
										<div class="form-group">
											<label for="phone" class="col-sm-3 control-label">手機 : </label>

											<div class="col-sm-8">
												
												<input  class="form-control" type="text" id="phone" name="phone" required value="<?php echo $row["phone"] ?>" >
											</div>
										</div>
										
										<!-- <tr>
                        <td class="right"><label for="work" class="label">工作</label></td>
                        <td><input type="text" class="col-6" id="work" name="work"  value="<?php echo $row["work"] ?>"></td>
                    </tr>
                    <tr>
                        <td class="right"><label for="school" class="label">學校</label></td>
                        <td><input type="text" class="col-6" id="school" name="school"  value="<?php echo $row["school"] ?>"></td>
                    </tr>
					 <tr>
                        <td class="right introduce"><label for="introduce" class="label">自我介紹</label></td>
                        <td><input type="textarea" id="introduce" name="introduce" class="col-9" value="<?php echo $row["introduce"] ?>" placeholder="請自我介紹一下，讓大家更加認識您！"></td>
                    <tr>-->
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="ibox">
								<div class="ibox-title tt">
									<h3 class="">非必填資訊</h3>
								</div>
								<div class="ibox-content">
									<div class="form-horizontal">
										<div class="form-group">
											<label for="introduce" class="col-sm-3 control-label">自我介紹 : </label>

											<div class="col-sm-8">
												<!--placeholder="請自我介紹一下，讓大家更加認識您！"-->
												<textarea  class="form-control" id="introduce" name="introduce" class="col-9" value="<?php echo $row["introduce"] ?>" placeholder="請自我介紹一下，讓大家更加認識您！"></textarea>
												<input name="work" type="hidden" value="">
												<input name="school" type="hidden" value="">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-3 col-sm-9">
												<!--<input type="submit" name="button" id="button" value="">-->
												<br/>
												<button class="btn btn-lg btn-primary" type="submit"> 存儲內容 </button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div><!--row end-->
					</div>
					</form>
				</div>
			</div>
			
			<!--<div id="edit-form">
				<form action="update_finish.php" method="post" name="formAdd" id="formAdd" enctype="multipart/form-data">
				<div id="pic-form">
					<div class="topic">
						<h2>個人資料相片</h2><hr/>
					</div>	
					<div id="form-control">
						<div id="pic">
							<?php
								if($row["picture"] == null){
									echo "<img src='img/selfie.png'/>";
								}else{
									echo "<img src='".$row['picture']."'/>";
								}
							?>
						</div>
						<div id="content">
							<p>清楚的正面有助用戶之間相互了解 , 請上載可清楚顯示面部的相片</p>
							<div class="button">
								<input type="file" class="inputFile" name="image" id="upload-button" value="請上傳相片">
							</div>
							<div>
								<img class="preview" style="max-width: 150px; max-height:150px">
								<div class="size"></div>
							</div>
						</div>
					</div>
				</div>
				<div id="content-form">
					<div class="topic">
						<h2>必填資訊</h2><hr/>
					</div>
					<table>
                    <tr>
                        <input name="id" type="hidden" value="<?php echo $row["uid"] ?>">
                        <td class="right"><label for="nickname" class="label">名字</label></td>
                        <td><input type="text" class="col-6" id="nickname" name="nickname" placeholder="名字" value="<?php echo $row["nickname"] ?>"></td>
                    </tr>
                    <tr>
                        <td class="right"><label for="birth" class="label">生日</label></td>
                        <td><input id="birth" type="date" name="birthday" class="col-6" value="<?php echo $row["birthday"] ?>" required></td>
                    </tr>
                    <tr>
                        <td class="right"><label for="email" class="label">EMAIL</label></td>
                        <td><input type="text" id="email" name="email" class="col-6" placeholder="NCNU EMAIL" required value="<?php echo $row["email"] ?>" ></td>
                    </tr>
                    <tr>
                        <td class="right"><label for="phone" class="label">手機</label></td>
                        <td><input type="text" id="phone" name="phone" class="col-6" required value="<?php echo $row["phone"] ?>" ></td>
                    <tr>
                    <tr>
                        <td class="right introduce"><label for="introduce" class="label">自我介紹</label></td>
                        <td><input type="textarea" id="introduce" name="introduce" class="col-9" value="<?php echo $row["introduce"] ?>" placeholder="請自我介紹一下，讓大家更加認識您！"></td>
                    <tr>
					</table>
				</div>
				<div id="form3">
					<div class="topic">
						<h2>非必填資訊</h2><hr/>
					</div>
					<table>
                    <tr>
                        <td class="right"><label for="work" class="label">工作</label></td>
                        <td><input type="text" class="col-6" id="work" name="work"  value="<?php echo $row["work"] ?>"></td>
                    </tr>
                    <tr>
                        <td class="right"><label for="school" class="label">學校</label></td>
                        <td><input type="text" class="col-6" id="school" name="school"  value="<?php echo $row["school"] ?>"></td>
                    </tr>
					</table>
				</div>
				<input type="submit" name="button" id="button" value="確定">
				</form>
			</div>-->
		</div>
		</div>
		
		<!-- /Home -->
		
		<!-- SupplyRecord -->
		<div id="supplyRecord" class="panel gray-bg">
			<div class="content">
				<div class="row">
				<div class="wrapper wrapper-content animated fadeInUp">

					<div class="col-sm-10">
						<div class="ibox">
							<div class="ibox-title">
								<h5 class="title"><i class="fa fa-history "> </i> 享.想 記錄</h5>
							</div>
							<div class="ibox-content">
								<div class="tabs-container">
									<ul class="nav nav-tabs">
										<li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-archive"></i> 物品</a>
										</li>
										<li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-user"></i> 服務</a>
										</li>
										<li class=""><a data-toggle="tab" href="#tab-3"><i class="fa fa-car"></i> 共乘</a>
										</li>
										<li class=""><a data-toggle="tab" href="#tab-4"><i class="fa fa-home"></i> 空間</a>
										</li>
										<li class=""><a data-toggle="tab" href="#tab-5"><i class="fa fa-briefcase"></i> 您提出過需求</a>
										</li>
									</ul>
									
									<div class="tab-content">
									<div id="tab-5" class="tab-pane ">
											<div class="panel-body">
												<div class="full-height-scroll">
													<div class="table-responsive">
														<table class="table table-striped table-hover">
														<?php
															$sql_dRecord = "select * from demand_list where provider = '".$_SESSION['user_id']."' ";
															$rs_dRecord = mysqli_query($db_conn,$sql_dRecord);
															while($row_dR = mysqli_fetch_array($rs_dRecord)){
																echo "<tr>";
																if($row_dR['d_status'] == 'on')
																{
																	echo "<td class='client-status'><span class='label label-primary'>發佈中 </span></td>";
																}
																else
																{
																	echo "<td class='client-status'><span class='label label-danger'>已下架 </span></td>";
																}
																if($row_dR['type'] == 'goods')
																{
																	echo "<td>物品類</td>";
																	echo "<td class='name'><a href='demand_goods_detail2.php?id=".$row_dR['id']."' target='_blank' >".$row_dR['name']."</a></td>";
																}
																else if($row_dR['type'] == 'service')
																{
																	echo "<td>服務類</td>";
																	echo "<td class='name'><a href='demand_service_detail2.php?id=".$row_dR['id']."' target='_blank' >".$row_dR['name']."</a></td>";
																}
																else if($row_dR['type'] == 'vehicle')
																{
																	echo "<td>共乘類</td>";
																	echo "<td class='name'><a href='demand_vehicle_detail2.php?id=".$row_dR['id']."' target='_blank' >".$row_dR['destination']."</a></td>";
																}
																else if($row_dR['type'] == 'space')
																{
																	echo "<td>空間類</td>";
																	echo "<td class='name'><a href='demand_space_detail2.php?id=".$row_dR['id']."' target='_blank' >".$row_dR['name']."</a></td>";
																}
																echo "<td class='description'>".mb_substr($row_dR["description"],0,30,'UTF-8')."..</td>";
																if($row_dR['d_status'] == 'on')
																{
																	echo "<td><a class='btn btn-primary btn-sm '><i class='fa fa-spin fa-gear'></i> 修改內容</a></td>";
																}
																else
																{
																	echo "<td><a class='btn btn-primary btn-sm '><i class='fa fa-spin fa-refresh'></i> 重新上架</a></td>";
																}
															}
                       /*if($row_dR['type'] == 'goods'){
                            echo "<tr>";
                            echo "<td><a href='demand_goods_detail.php?id=".$row_dR['id']."' target='_blank' >".$row_dR['name']."</a></td>";
                            echo "<td>物品類</td>";
                            if($row_dR['d_status'] == 'on'){
                                echo "<td><a href='demand_goods_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                            	echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                               	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                        if($row_dR['type'] == 'service'){
                            echo "<tr>";
                            echo "<td><a href='demand_service_detail.php?id=".$row_dR["id"]."' target='_blank' >".$row_dR['name']."</a></td>";
                            echo "<td>服務類</td>";
                            if($row_dR['d_status'] == 'on'){
                                echo "<td><a href='demand_service_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                                echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                              	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                        if($row_dR['type'] == 'space'){
                            echo "<tr>";
                            echo "<td><a href='demand_space_detail.php?id=".$row_dR["id"]."' target='_blank' >".$row_dR['name']."</a></td>";
                            echo "<td>空間類</td>";
                            if($row_dR['d_status'] == 'on'){
                            	echo "<td><a href='demand_space_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                            	echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                               	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                        if($row_dR['type'] == 'vehicle'){
                            echo "<tr>";
                            echo "<td><a href='demand_vehicle_detail.php?id=".$row_dR["id"]."' target='_blank' >".$row_dR['destination']."</a></td>";
                            echo "<td>共乘類</td>";
                           
                            if($row_dR['d_status'] == 'on'){
                            	echo "<td><a href='demand_vehicle_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                             	echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                               	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                    }*/
														?>
														</table>
													</div>
												</div>
											</div>
										</div>
									<div id="tab-4" class="tab-pane ">
											<div class="panel-body">
												<div class="full-height-scroll">
													<div class="table-responsive">
														<table class="table table-striped table-hover">
														<?php
															$sql = "select a.*, b.*, c.* from supply_space_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'goods' and a.provider ='".$_SESSION['user_id']."' ";
															$result = mysqli_query($db_conn,$sql);
															while($row = mysqli_fetch_array($result))
															{
																echo "<tr>";
																if($row['s_status'] == "on")
																{
																	echo "<td class='client-status'><span class='label label-primary'>發佈中 </span></td>";
																	echo "<td class='img-adjust'><img src='".$row["image"]."' class='img-responsive'></td>";
																	echo "<td><a class='name' href='supply_space_detail2.php?id=".$row["id"]."'>".$row['name']."</a></td>";
																	echo "<td class='date'><small>NT</small>  ".$row["price"]."</td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> 發佈于".date('m\月d\日',strtotime($row['post_date']))."</td>";
																	echo "<td><a class='btn btn-primary btn-sm '><i class='fa fa-spin fa-gear'></i> 修改內容</a></td>";
																}
																else
																{
																	echo "<td class='client-status'><span class='label label-danger'>已下架 </span></td>";
																	echo "<td class='img-adjust'><img src='".$row["image"]."' class='img-responsive'></td>";
																	echo "<td><a class='name' href='supply_space_detail2.php?id=".$row["id"]."'>".$row['name']."</a></td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> 發佈于".date('m\月d\日',strtotime($row['post_date']))."</td>";
																	echo "<td><a class='btn btn-primary btn-sm '><i class='fa fa-spin fa-refresh'></i> 重新上架</a></td>";
																}
																
																
															}
														?>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div id="tab-3" class="tab-pane ">
											<div class="panel-body">
												<div class="full-height-scroll">
													<div class="table-responsive">
														<table class="table table-striped table-hover">
														<?php
															$sql = "select a.*, b.*, c.* from supply_vehicle_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'goods' and a.provider ='".$_SESSION['user_id']."' ";
															$result = mysqli_query($db_conn,$sql);
															while($row = mysqli_fetch_array($result))
															{
																echo "<tr>";
																if($row['type2'] == "car")
																{
																	$icon = "fa fa-car";
																}
																else if($row['type2'] == "motor")
																{
																	$icon = "fa fa-motorcycle";
																}
																else if($row['type2'] == "other")
																{
																	$icon = "fa fa-bus";
																}
																
																if($row['s_status'] == "on")
																{
																	echo "<td class='client-status'><span class='label label-primary'>發佈中 </span></td>";
																	echo "<td class='icon-adjust'><div class='icon'><i class='".$icon."'></i> </div></td>";
																	
																	                                  
																	echo "<td><a class='name' href='supply_vehicle_detail2.php?id=".$row["id"]."'>".$row['destination']."</a></td>";
																	echo "<td class='date'><small>NT</small>  ".$row["price"]."</td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> 發佈于".date('m\月d\日',strtotime($row['post_date']))."</td>";
																	echo "<td><a class='btn btn-primary btn-sm '><i class='fa fa-spin fa-gear'></i> 修改內容</a></td>";
																}
																else
																{
																	echo "<td class='client-status'><span class='label label-danger'>已下架 </span></td>";
																	echo "<td class='icon-adjust'><div class='icon'><i class='".$icon."'></i> </div></td>";
																	echo "<td><a class='name' href='supply_vehicle_detail2.php?id=".$row["id"]."'>".$row['destination']."</a></td>";
																	echo "<td class='date'><small>NT</small>  ".$row["price"]."</td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> 發佈于".date('m\月d\日',strtotime($row['post_date']))."</td>";
																	echo "<td><a class='btn btn-primary btn-sm '><i class='fa fa-spin fa-refresh'></i> 重新上架</a></td>";
																}
																
																
															}
														?>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div id="tab-2" class="tab-pane ">
											<div class="panel-body">
												<div class="full-height-scroll">
													<div class="table-responsive">
														<table class="table table-striped table-hover">
														<?php
															$sql = "select a.*, b.*, c.* from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'goods' and a.provider ='".$_SESSION['user_id']."' ";
															$result = mysqli_query($db_conn,$sql);
															while($row = mysqli_fetch_array($result))
															{
																echo "<tr>";
																if($row['type2'] == "bytime")
																{
																	$icon = "fa fa-hourglass";
																}
																else if($row['type2'] == "bypic")
																{
																	$icon = "fa fa-file";
																}
																else if($row['type2'] == "other")
																{
																	$icon = "fa fa-pencil-square";
																}
																
																if($row['s_status'] == "on")
																{
																	echo "<td class='client-status'><span class='label label-primary'>發佈中 </span></td>";
																	echo "<td class='icon-adjust'><div class='icon'><i class='".$icon."'></i> </div></td>";
																	
																	                                  
																	echo "<td><a class='name' href='supply_service_detail2.php?id=".$row["id"]."'>".$row['name']."</a></td>";
																	echo "<td class='date'><small>NT</small>  ".$row["price"]."</td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> 發佈于".date('m\月d\日',strtotime($row['post_date']))."</td>";
																	echo "<td><a class='btn btn-primary btn-sm '><i class='fa fa-spin fa-gear'></i> 修改內容</a></td>";
																}
																else
																{
																	echo "<td class='client-status'><span class='label label-danger'>已下架 </span></td>";
																	echo "<td class='icon-adjust'><div class='icon'><i class='".$icon."'></i> </div></td>";
																	echo "<td><a class='name' href='supply_service_detail2.php?id=".$row["id"]."'>".$row['name']."</a></td>";
																	echo "<td class='date'><small>NT</small>  ".$row["price"]."</td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> 發佈于".date('m\月d\日',strtotime($row['post_date']))."</td>";
																	echo "<td><a class='btn btn-primary btn-sm '><i class='fa fa-spin fa-refresh'></i> 重新上架</a></td>";
																}
																
																
															}
														?>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div id="tab-1" class="tab-pane active">
											<div class="panel-body">
												<div class="full-height-scroll">
													<div class="table-responsive">
														<table class="table table-striped table-hover">
														<?php
															$sql = "select a.*, b.*, c.* from supply_goods_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'goods' and a.provider ='".$_SESSION['user_id']."' ";
															$result = mysqli_query($db_conn,$sql);
															while($row = mysqli_fetch_array($result))
															{
																echo "<tr>";
																if($row['s_status'] == "on")
																{
																	echo "<td class='client-status'><span class='label label-primary'>發佈中 </span></td>";
																	echo "<td class='img-adjust'><img src='".$row["image"]."' class='img-responsive'></td>";
																	echo "<td><a class='name' href='supply_goods_detail2.php?id=".$row["id"]."'>".$row['name']."</a></td>";
																	echo "<td class='date'><small>NT</small>  ".$row["price"]."</td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> 發佈于".date('m\月d\日',strtotime($row['post_date']))."</td>";
																	echo "<td><a class='btn btn-primary btn-sm '><i class='fa fa-spin fa-gear'></i> 修改內容</a></td>";
																}
																else
																{
																	echo "<td class='client-status'><span class='label label-danger'>已下架 </span></td>";
																	echo "<td class='img-adjust'><img src='".$row["image"]."' class='img-responsive'></td>";
																	echo "<td><a class='name' href='supply_goods_detail2.php?id=".$row["id"]."'>".$row['name']."</a></td>";
																	echo "<td class='date'><i class='fa fa-calendar-o'></i> 發佈于".date('m\月d\日',strtotime($row['post_date']))."</td>";
																	echo "<td><a class='btn btn-primary btn-sm '><i class='fa fa-spin fa-refresh'></i> 重新上架</a></td>";
																}
																
																
															}
														?>
														</table>
													</div>
												</div>
											</div>
										</div>
									
										
									
									</div>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
				</div>
				<!--<div class="tab">
					<div class="menu_list SupplyRd">
						<p>我的提供記錄</p>
					</div>
					<table class="list_table SupplyRd">
						<tr>
						<th>標題</th>
						<th>類別</th>
						<th>狀態</th>
						<th>動作</th>
						</tr>
						<?php
							$sql = "select a.*, b.*, c.* from supply_goods_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'goods' and a.provider ='".$_SESSION['user_id']."' ";
							$result = mysqli_query($db_conn,$sql);
							while($row = mysqli_fetch_array($result))
							{
								
								echo "<tr><td><a href='supply_goods_detail2.php?id=".$row["id"]."'>".$row['name']."</td></a>";
								echo "<td>物品類</td>";
								echo "<td>--</td>";
								echo "<td>--</td></tr>";
							}
							$sql = "select a.*, b.*, c.* from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'goods' and a.provider ='".$_SESSION['user_id']."' ";
							$result = mysqli_query($db_conn,$sql);
							while($row = mysqli_fetch_array($result))
							{
								
								echo "<tr><td><a href='supply_service_detail2.php?id=".$row["id"]."'>".$row['name']."</a></td>";
								echo "<td>服務提供類</td>";
								echo "<td>--</td>";
								echo "<td>--</td></tr>";
							}
							$sql = "select a.*, b.*, c.* from supply_vehicle_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'goods' and a.provider ='".$_SESSION['user_id']."' ";
							$result = mysqli_query($db_conn,$sql);
							while($row = mysqli_fetch_array($result))
							{
								
								echo "<tr><td><a href='supply_vehicle_detail2.php?id=".$row["id"]."'>".$row['destination']."</a></td>";
								echo "<td>共乘類</td>";
								echo "<td>--</td>";
								echo "<td>--</td></tr>";
							}
							$sql = "select a.*, b.*, c.* from supply_space_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'goods' and a.provider ='".$_SESSION['user_id']."' ";
							$result = mysqli_query($db_conn,$sql);
							while($row = mysqli_fetch_array($result))
							{
								
								echo "<tr><td><a href='supply_space_detail2.php?id=".$row["id"]."'>".$row['name']."</a></td>";
								echo "<td>空間類</td>";
								echo "<td>--</td>";
								echo "<td>--</td></tr>";
							}
						?>
					</table>
				</div>-->
				<!--<div class="tab">
					<div class="menu_list DemandRd">
						<p>我的需求記錄</p>
					</div>
					<table class="list_table DemandRd">
					<tr>
						<th>標題</th>
						<th>類別</th>
						<th>狀態</th>
						<th>動作</th>
					</tr>
					<?php 
                    $sql_dRecord = "select * from demand_list where provider = '".$_SESSION['user_id']."' ";
                    $rs_dRecord = mysqli_query($db_conn,$sql_dRecord);
                    while($row_dR = mysqli_fetch_array($rs_dRecord)){
                        if($row_dR['type'] == 'goods'){
                            echo "<tr>";
                            echo "<td><a href='demand_goods_detail.php?id=".$row_dR['id']."' target='_blank' >".$row_dR['name']."</a></td>";
                            echo "<td>物品類</td>";
                            if($row_dR['d_status'] == 'on'){
                                echo "<td><a href='demand_goods_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                            	echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                               	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                        if($row_dR['type'] == 'service'){
                            echo "<tr>";
                            echo "<td><a href='demand_service_detail.php?id=".$row_dR["id"]."' target='_blank' >".$row_dR['name']."</a></td>";
                            echo "<td>服務類</td>";
                            if($row_dR['d_status'] == 'on'){
                                echo "<td><a href='demand_service_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                                echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                              	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                        if($row_dR['type'] == 'space'){
                            echo "<tr>";
                            echo "<td><a href='demand_space_detail.php?id=".$row_dR["id"]."' target='_blank' >".$row_dR['name']."</a></td>";
                            echo "<td>空間類</td>";
                            if($row_dR['d_status'] == 'on'){
                            	echo "<td><a href='demand_space_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                            	echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                               	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                        if($row_dR['type'] == 'vehicle'){
                            echo "<tr>";
                            echo "<td><a href='demand_vehicle_detail.php?id=".$row_dR["id"]."' target='_blank' >".$row_dR['destination']."</a></td>";
                            echo "<td>共乘類</td>";
                           
                            if($row_dR['d_status'] == 'on'){
                            	echo "<td><a href='demand_vehicle_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                             	echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                               	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                    }
                ?>
					</table>
				</div>-->
				<!--<div id="body_list">
					<h1>較早前</h1>
					<div class="record">
						<div class="r_img">
							<img src="img/bike.jpg"/>
						</div>
						<div class="info">
							<h1>標題</h1>
							<p>內容</p>
							<a class='zoomIn dialog'><button class='edit' >修改</button></a>
						</div>
						
					</div>
					<div class="record">
						<div class="r_img">
							<img src="img/bike.jpg"/>
						</div>
						<div class="info">
							<h1>標題</h1>
							<p>內容</p>
						</div>
					</div>
				</div>-->
				<!--<div class="team-members row">
            <?php
				//goods
				$sql_supplygoods = "select a.*, b.*, c.* from supply_goods_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'goods' and a.provider ='".$_SESSION['user_id']."' "; 
				$rs_supplygoods = mysqli_query($db_conn,$sql_supplygoods);
                while($row_sgd = mysqli_fetch_array($rs_supplygoods)){
					echo "<div class='block'>";
						echo "<div class='single-member effect-2'>";
							echo "<div class='member-image'>";
								echo "<a href='supply_goods_detail.php?id=".$row_sgd["id"]."' target='_blank'><img src='".$row_sgd["image"]."' alt='Member' ></a>";
							echo "</div>";
							echo "<div class='member-info'>";
								echo "<h3>".$row_sgd["name"]."</h3>";
								echo "<h5><small>by</small>".$row_sgd["nickname"]."<p class='price' >NT$ ".$row_sgd["price"]."</p></h5>";
								echo "<table border='0' id='info'>";
								echo "<tr>";
									echo "<td class='right'>用途/功能：</td>";
									echo "<td class='left'>".$row_sgd["description"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td class='right'>品牌： </td>";
									echo "<td class='left'>".$row_sgd["brand"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td class='right'>發帖時間： </td>";
									echo "<td class='left'>".date('d M Y',strtotime($row_sgd["post_date"]))."</td>";
								echo "</tr>";
								echo "</table>";
								echo "<div class='social-touch'>";
								echo "<a class='fb-touch' href='#'></a>";
								echo "<a class='tweet-touch' href='#'></a>";
								echo "<a class='linkedin-touch' href='#'></a>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
						echo "<div class='button-wrap'>";
							if($row_sgd["s_status"] == 'on'){
								echo "<a class='zoomIn dialog'><button class='edit' >修改</button></a>";
							}else if($row_sgd["s_status"] == 'down'){
								echo "<a class='zoomIn dialog'><button class='edit' >修改</button></a>";
								echo "<button class='reupload'><a href='provider_reuploadDB.php?s_id=".$row_sgd['s_id']."&sl_id=".$row_sgd['sl_id']."&sd=supply&type=goods' style='color:white;'>重新上架</a></button>";
							}
						echo "</div>";
					echo "</div>";
				}
				//service
				$sql_supplyservice = "select a.*, b.*, c.* from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'service' and a.provider ='".$_SESSION['user_id']."' "; 
				$rs_supplyservice = mysqli_query($db_conn,$sql_supplyservice);
                while($row_ssv = mysqli_fetch_array($rs_supplyservice)){
					echo "<div class='block'>";
						echo "<div class='single-member effect-2'>";
							echo "<div class='member-image'>";
								echo "<a href='supply_service_detail.php?id=".$row_ssv["id"]."' target='_blank'><img src='uploadfile/itemicon.png' alt='Member' ></a>";
							echo "</div>";
							echo "<div class='member-info'>";
								echo "<h3>".$row_ssv["name"]."</h3>";
								echo "<h5><small>by</small>".$row_ssv["nickname"]."<p class='price' >NT$ ".$row_ssv["price"]."</p></h5>";
								echo "<table border='0' id='info'>";
								echo "<tr>";
									echo "<td class='right'>地點：</td>";
									echo "<td class='left'>".$row_ssv["location"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td class='right'>發帖時間： </td>";
									echo "<td class='left'>".date('d M Y',strtotime($row_ssv["post_date"]))."</td>";
								echo "</tr>";
								echo "</table>";
								echo "<div class='social-touch'>";
								echo "<a class='fb-touch' href='#'></a>";
								echo "<a class='tweet-touch' href='#'></a>";
								echo "<a class='linkedin-touch' href='#'></a>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
						echo "<div class='button-wrap'>";
							if($row_ssv["s_status"] == 'on'){
								echo "<a class='zoomIn dialog'><button class='edit' >修改</button></a>";
							}else if($row_ssv["s_status"] == 'down'){
								echo "<a class='zoomIn dialog'><button class='edit' >修改</button></a>";
								echo "<button class='reupload'><a href='provider_reuploadDB.php?s_id=".$row_ssv['s_id']."&sl_id=".$row_ssv['sl_id']."&sd=supply&type=service' style='color:white;'>重新上架</a></button>";
							}
						echo "</div>";
					echo "</div>";
				}
				//space
				$sql_supplyspace = "select a.*, b.*, c.* from supply_space_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'space' and a.provider ='".$_SESSION['user_id']."' "; 
				$rs_supplyspace = mysqli_query($db_conn,$sql_supplyspace);
                while($row_ssp = mysqli_fetch_array($rs_supplyspace)){
					echo "<div class='block'>";
						echo "<div class='single-member effect-2'>";
							echo "<div class='member-image'>";
								echo "<a href='supply_space_detail.php?id=".$row_ssp["id"]."' target='_blank'><img src='".$row_ssp["image"]."' alt='Member' ></a>";
							echo "</div>";
							echo "<div class='member-info'>";
								echo "<h3>".$row_ssp["name"]."</h3>";
								echo "<h5><small>by</small>".$row_ssp["nickname"]."<p class='price' >NT$ ".$row_ssp["price"]."</p></h5>";
								echo "<table border='0' id='info'>";
								echo "<tr>";
									echo "<td class='right'>地點：</td>";
									echo "<td class='left'>".$row_ssp["location"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td class='right'>大小： </td>";
									echo "<td class='left'>".$row_ssp["space_size"]."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td class='right'>發帖時間： </td>";
									echo "<td class='left'>".date('d M Y',strtotime($row_ssp["post_date"]))."</td>";
								echo "</tr>";
								echo "</table>";
								echo "<div class='social-touch'>";
								echo "<a class='fb-touch' href='#'></a>";
								echo "<a class='tweet-touch' href='#'></a>";
								echo "<a class='linkedin-touch' href='#'></a>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
						echo "<div class='button-wrap'>";
							if($row_ssp["s_status"] == 'on'){
								echo "<a class='zoomIn dialog'><button class='edit' >修改</button></a>";
							}else if($row_ssp["s_status"] == 'down'){
								echo "<a class='zoomIn dialog'><button class='edit' >修改</button></a>";
								echo "<button class='reupload'><a href='provider_reuploadDB.php?s_id=".$row_ssp['s_id']."&sl_id=".$row_ssp['sl_id']."&sd=supply&type=space' style='color:white;'>重新上架</a></button>";
							}
						echo "</div>";
					echo "</div>";
				}
				//vehicle
				$sql_supplyvehicle = "select a.*, b.*, c.* from supply_vehicle_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'vehicle' and a.provider ='".$_SESSION['user_id']."' "; 
				$rs_supplyvehicle = mysqli_query($db_conn,$sql_supplyvehicle);
                while($row_svh = mysqli_fetch_array($rs_supplyvehicle)){
					echo "<div class='block'>";
						echo "<div class='single-member effect-2'>";
							echo "<div class='member-image'>";
								echo "<a href='supply_vehicle_detail.php?id=".$row_svh["id"]."' target='_blank'><img src='uploadfile/itemicon.png' alt='Member' ></a>";
							echo "</div>";
							echo "<div class='member-info'>";
								echo "<h3>".$row_svh["destination"]."</h3>";
								echo "<h5><small>by</small>".$row_svh["nickname"]."<p class='price' >NT$ ".$row_svh["price"]."</p></h5>";
								echo "<table border='0' id='info'>";
								echo "<tr>";
									echo "<td class='right'>出發日期：</td>";
									echo "<td class='left'>".date('d M Y',strtotime($row_svh["vehicle_date"]))."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td class='right'>出發時間： </td>";
									echo "<td class='left'>".date('g:ia',strtotime($row_svh["vehicle_date"]))."</td>";
								echo "</tr>";
								echo "<tr>";
									echo "<td class='right'>發帖時間： </td>";
									echo "<td class='left'>".date('d M Y',strtotime($row_svh["post_date"]))."</td>";
								echo "</tr>";
								echo "</table>";
								echo "<div class='social-touch'>";
								echo "<a class='fb-touch' href='#'></a>";
								echo "<a class='tweet-touch' href='#'></a>";
								echo "<a class='linkedin-touch' href='#'></a>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
						echo "<div class='button-wrap'>";
							if($row_svh["s_status"] == 'on'){
								echo "<a class='zoomIn dialog'><button class='edit' >修改</button></a>";
							}else if($row_svh["s_status"] == 'down'){
								echo "<a class='zoomIn dialog'><button class='edit' >修改</button></a>";
								echo "<button class='reupload'><a href='provider_reuploadDB.php?s_id=".$row_svh['s_id']."&sl_id=".$row_svh['sl_id']."&sd=supply&type=vehicle' style='color:white;'>重新上架</a></button>";
							}
						echo "</div>";
					echo "</div>";
				}
			?> 
				</div>-->
			</div>
			<!-- 注意：请将要放入弹框的内容放在比如id="HBox"的容器中，然后将box的值换成该ID即可，比如：$(element).hDialog({'box':'#HBox'}); -->
		</div>
		<!-- /SupplyRecord -->
		
		<!-- DemandRecord -->
		<!--<div id="demandRecord" class="panel">
			<div class="content">
				<table id="myDemand">
                <tr>
                	<th>需求記錄</th>
                </tr>
                <tr>
                	<th>您的需求</th>
                    <th>類別</th>
                    <th>狀態</th>
                    <th>動作</th>
                </tr>
				<?php 
                    $sql_dRecord = "select * from demand_list where provider = '".$_SESSION['user_id']."' ";
                    $rs_dRecord = mysqli_query($db_conn,$sql_dRecord);
                    while($row_dR = mysqli_fetch_array($rs_dRecord)){
                        if($row_dR['type'] == 'goods'){
                            echo "<tr>";
                            echo "<td><a href='demand_goods_detail.php?id=".$row_dR['id']."' target='_blank' >".$row_dR['name']."</a></td>";
                            echo "<td>物品類</td>";
                            if($row_dR['d_status'] == 'on'){
                                echo "<td><a href='demand_goods_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                            	echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                               	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                        if($row_dR['type'] == 'service'){
                            echo "<tr>";
                            echo "<td><a href='demand_service_detail.php?id=".$row_dR["id"]."' target='_blank' >".$row_dR['name']."</a></td>";
                            echo "<td>服務類</td>";
                            if($row_dR['d_status'] == 'on'){
                                echo "<td><a href='demand_service_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                                echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                              	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                        if($row_dR['type'] == 'space'){
                            echo "<tr>";
                            echo "<td><a href='demand_space_detail.php?id=".$row_dR["id"]."' target='_blank' >".$row_dR['name']."</a></td>";
                            echo "<td>空間類</td>";
                            if($row_dR['d_status'] == 'on'){
                            	echo "<td><a href='demand_space_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                            	echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                               	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                        if($row_dR['type'] == 'vehicle'){
                            echo "<tr>";
                            echo "<td><a href='demand_vehicle_detail.php?id=".$row_dR["id"]."' target='_blank' >".$row_dR['destination']."</a></td>";
                            echo "<td>共乘類</td>";
                           
                            if($row_dR['d_status'] == 'on'){
                            	echo "<td><a href='demand_vehicle_detail.php?id=".$row_dR["id"]."' target='_blank' >上架中</a></td>";
                                echo "<td>修改內容</td>";
                            }else if($row_dR['d_status'] == 'down'){
                             	echo "<td><a href='user-edit.php#tradeRecord'>需求被滿足</a></td>";
                               	echo "<td>修改內容 / <a href='provider_reuploadDB.php?id=".$row_dR['id']."&sd=demand' style='color:black;'>重新上架</a></td>";
                            }
                            echo "</tr>";
                        }
                    }
                ?>
                </table>
			</div>
		</div>
		<!-- /DemandRecord -->
		
		<!-- tradeRecord -->
		<div id="tradeRecord" class="panel">
			<div class="content">
            	<section id="tabContainer1" class="jQdmtab tabContainer">
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
                                        echo "<td><a href='supply_goods_detail.php?id=".$row_q2['id']."' target='_black'>".$row_q2['name']."</a></td>";
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
                                        echo "<td><a href='supply_service_detail.php?id=".$row_q2['id']."' target='_black'>".$row_q2['name']."</a></td>";
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
                                        echo "<td><a href='supply_space_detail.php?id=".$row_q2['id']."' target='_black'>".$row_q2['name']."</a></td>";
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
                                        echo "<td><a href='supply_vehicle_detail.php?id=".$row_q2['id']."' target='_black'>".$row_q2['destination']."</a></td>";
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
                </section>
			</div>
		</div>
        
		<!-- /tradeRecord -->
		<div id="menu">
			<h1>歡迎您<br/><?php echo $nickname ?>！！</h1>
			<ul id="navigation">
				<li><a id="link-home" href="#home">修改個人資料</a></li>
				<li><a id="link-portfolio" href="#supplyRecord">提供與需求記錄</a></li>
				<!--<li><a id="link-about" href="#demandRecord">需求記錄</a></li>-->
				<li><a id="link-contact" href="user-record.php#tradeRecord">交易記錄
                <?php
					if($_SESSION['total_trade'] != 0){
	                	echo "[".$_SESSION['total_trade']."]";
						//unset($_SESSION['total_trade']);
					}
				?>
                </a></li>
			</ul>
		</div>
		
	</div>
	
    
	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery.hDialog.min.js"></script>
	
	<script src="js/libs_useso.js"></script>
	<script type="text/javascript" src="js/jquery.toast.js"></script>
    <script src="js/script-tabPanel.js"></script>
	
	<!-- 全局js -->
    <script src="bootstrap/js/jquery.min.js?v=2.1.4"></script>
    <script src="bootstrap/js/bootstrap.min.js?v=3.3.6"></script>

    <script src="bootstrap/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
</body>
</html>