<?php
session_start();
include("connMysql.php");
$id=(int)$_GET['id'];
if($id<=0){
	echo "empty ID";
	exit(0);
}

?>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
		<title>TbS</title>
        <link rel="shortcut icon" href="img/favicon.ico" />
		<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" href="css/profile-style.css" type="text/css" />
	</head>
	<body>
		<div id="headerTopicContainer"></div>
			<div id="header">
			<?php 
				if(!isset($_SESSION['user_id'])){
					require ("header.php");
            	}else{
					require ("header_login.php");
				}
            ?></div>
		<div id="wrapper">
        
			<div id = "contentCotainer">
				<div class="mainContent">
				<?php
					$sql = "select * from user_list where uid ='".$id."'";
					$result = mysqli_query($db_conn,$sql);
					$row = mysqli_fetch_array($result);
				?>
					<h1>您好！我是<?php echo $row['nickname']?></h1>
                    <p><?php
						error_reporting(E_ERROR); //先將錯誤等級設為 E_ERROR（執行時期致命的錯誤）
						$userScore = ($row['score']/$row['score_num_ppl']);
						error_reporting(E_WARNING); //所以不會出現WARNING信息（執行時期錯誤警告）
						for($i=1;$i<=intval($userScore);$i++){
							echo "<img src='img/star-on-big.png'>";
						}
						if(intval($userScore) < 5){
							$starOffBig = 5 - intval($userScore); 
							for($i=1;$i<=$starOffBig;$i++){
								echo "<img src='img/star-off-big.png'>";
							}
						}
					?><p>
					<p>註冊時間：<?php echo date('d\日m\月Y\年',strtotime($row["register_date"]))?></p>
					<h2>評價..</h2>
                    <?php
						$sql_qy1 = "select * from user_trade a LEFT OUTER JOIN supply_list b on a.product_id = b.sl_id";
						$rs_qy1 = mysqli_query($db_conn,$sql_qy1);
						while($row_qy1 = mysqli_fetch_array($rs_qy1)){
							if($row_qy1['requester_score'] != 'no' && $row_qy1['s_type'] == 'goods'){
								$sql_qy2 = "select * from supply_goods_list where id = '".$row_qy1['s_id']."' and provider = '".$id."' ";
								$rs_qy2 = mysqli_query($db_conn,$sql_qy2);
								while($row_qy2 = mysqli_fetch_array($rs_qy2)){
									$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
									$rs_rqID = mysqli_query($db_conn,$sql_rqID);
									$row_rqID = mysqli_fetch_array($rs_rqID);
									echo "<table id='comment' border='0'>";
									echo "<tr>";
									echo "<td width='120px;' rowspan='3' style='text-align:center;'><img class='comImg' src=".$row_rqID['picture']."></td>";
									echo "<td class='name'>".$row_rqID['nickname']."</td>";
									
									echo "<td style='text-align:right;'>評論時間: ".date('Y年m月d日 g:ia',strtotime($row_qy1['requester_comment_date']))."</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td class='category'>(物品) ".$row_qy2['name']."</td>";
									echo "<td style='text-align:right;'>";
									
									for($i=1;$i<=$row_qy1['requester_score'];$i++){
										echo "<img src='img/star-on.png'>";
									}
									if($row_qy1['requester_score'] < 5){
										$whiteStar = 5 - $row_qy1['requester_score']; 
										for($i=1;$i<=$whiteStar;$i++){
											echo "<img src='img/star-off.png'>";
										}
									}
									echo " </td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td colspan='2'>".$row_qy1['requester_comment']."</td>";
									echo "</tr>";
									echo "</table>";
								}
							}else if($row_qy1['requester_score'] != 'no' && $row_qy1['s_type'] == 'service'){
								$sql_qy2 = "select * from supply_service_list where id = '".$row_qy1['s_id']."' and provider = '".$id."' ";
								$rs_qy2 = mysqli_query($db_conn,$sql_qy2);
								while($row_qy2 = mysqli_fetch_array($rs_qy2)){
									$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
									$rs_rqID = mysqli_query($db_conn,$sql_rqID);
									$row_rqID = mysqli_fetch_array($rs_rqID);
									echo "<table id='comment'>";
									echo "<tr>";
									echo "<td width='120px;' rowspan='3' style='text-align:center;'><img class='comImg' src=".$row_rqID['picture']."></td>";
									echo "<td class='name'>".$row_rqID['nickname']."</td>";
									
									echo "<td style='text-align:right;'>評論時間: ".date('Y年m月d日 g:ia',strtotime($row_qy1['requester_comment_date']))."</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td class='category'>(服務) ".$row_qy2['name']."</td>";
									echo "<td style='text-align:right;'> ";
									for($i=1;$i<=$row_qy1['requester_score'];$i++){
										echo "<img src='img/star-on.png'>";
									}
									if($row_qy1['requester_score'] < 5){
										$whiteStar = 5 - $row_qy1['requester_score']; 
										for($i=1;$i<=$whiteStar;$i++){
											echo "<img src='img/star-off.png'>";
										}
									}
									echo " </td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td colspan='2'>".$row_qy1['requester_comment']."</td>";
									echo "</tr>";
									echo "</table>";
								}
							}else if($row_qy1['requester_score'] != 'no' && $row_qy1['s_type'] == 'space'){
								$sql_qy2 = "select * from supply_space_list where id = '".$row_qy1['s_id']."' and provider = '".$id."' ";
								$rs_qy2 = mysqli_query($db_conn,$sql_qy2);
								while($row_qy2 = mysqli_fetch_array($rs_qy2)){
									$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
									$rs_rqID = mysqli_query($db_conn,$sql_rqID);
									$row_rqID = mysqli_fetch_array($rs_rqID);
									echo "<table id='comment'>";
									echo "<tr>";
									echo "<td width='120px;' rowspan='3' style='text-align:center;'><img class='comImg' src=".$row_rqID['picture']."></td>";
									echo "<td class='name'>".$row_rqID['nickname']."</td>";
									
									echo "<td style='text-align:right;'>評論時間: ".date('Y年m月d日 g:ia',strtotime($row_qy1['requester_comment_date']))."</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td class='category'>(空間) ".$row_qy2['name']."</td>";
									echo "<td style='text-align:right;'>";
									for($i=1;$i<=$row_qy1['requester_score'];$i++){
										echo "<img src='img/star-on.png'>";
									}
									if($row_qy1['requester_score'] < 5){
										$whiteStar = 5 - $row_qy1['requester_score']; 
										for($i=1;$i<=$whiteStar;$i++){
											echo "<img src='img/star-off.png'>";
										}
									}
									echo " </td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td colspan='2'>".$row_qy1['requester_comment']."</td>";
									echo "</tr>";
									echo "</table>";
								}
							}else if($row_qy1['requester_score'] != 'no' && $row_qy1['s_type'] == 'vehicle'){
								$sql_qy2 = "select * from supply_vehicle_list where id = '".$row_qy1['s_id']."' and provider = '".$id."' ";
								$rs_qy2 = mysqli_query($db_conn,$sql_qy2);
								while($row_qy2 = mysqli_fetch_array($rs_qy2)){
									$sql_rqID = "select * from user_list where uid ='".$row_qy1['requester_id']."' ";
									$rs_rqID = mysqli_query($db_conn,$sql_rqID);
									$row_rqID = mysqli_fetch_array($rs_rqID);
									echo "<table id='comment'>";
									echo "<tr>";
									echo "<td width='120px;' rowspan='3' style='text-align:center;'><img class='comImg' src=".$row_rqID['picture']."></td>";
									echo "<td class='name'>".$row_rqID['nickname']."</td>";
									
									echo "<td style='text-align:right;'>評論時間: ".date('Y年m月d日 g:ia',strtotime($row_qy1['requester_comment_date']))."</td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td class='category'>(共乘類) ".$row_qy2['destination']."</td>";
									echo "<td style='text-align:right;'>評分: ";
									for($i=1;$i<=$row_qy1['requester_score'];$i++){
										echo "<img src='img/star-on.png'>";
									}
									if($row_qy1['requester_score'] < 5){
										$whiteStar = 5 - $row_qy1['requester_score']; 
										for($i=1;$i<=$whiteStar;$i++){
											echo "<img src='img/star-off.png'>";
										}
									}
									echo " </td>";
									echo "</tr>";
									echo "<tr>";
									echo "<td colspan='2'>".$row_qy1['requester_comment']."</td>";
									echo "</tr>";
									echo "</table>";
								}
							}
						}
					?>
				</div>
				<aside>
					<div id="user-pic">
						<?php
							if($row["picture"]==null)
							{
								$pic = "img/selfie.png";
							}
							else
							{
								$pic = $row['picture'];
							}
							echo "<img src='$pic'>";
						?>
					</div>
					<div id ="user-info">
						<div class = "title">
							<h2>個人資料</h2>
						</div>
						<table border="0">
							<tr>
								<td>EMAIL<br/><small><?php echo $row['email']?></small></td>
							</tr>
							<tr>
								<td>手機<br/><small><?php echo $row['phone']?></small></td>
							</tr>
						</table>
					</div>
					<div id ="record">
						<?php
							$sql_total = "select count(*) from supply_goods_list where provider='".$id."'";
							$result_total = mysqli_query($db_conn,$sql_total);
							$total = mysqli_fetch_row($result_total);
							$total = ceil($total[0]);

							$sql_total = "select count(*) from supply_space_list where provider='".$id."'";
							$result_total = mysqli_query($db_conn,$sql_total);
							$total2 = mysqli_fetch_row($result_total);
							$total = $total+ceil($total2[0]);
							
							$sql_total = "select count(*) from supply_service_list where provider='".$id."'";
							$result_total = mysqli_query($db_conn,$sql_total);
							$total3 = mysqli_fetch_row($result_total);
							$total = $total+ceil($total3[0]);
							
							$sql_total = "select count(*) from supply_vehicle_list where provider='".$id."'";
							$result_total = mysqli_query($db_conn,$sql_total);
							$total4 = mysqli_fetch_row($result_total);
							$total = $total+ceil($total4[0]);
							//$total = (int)$total+(int)$total2+(int)$total3+(int)$total4;
							echo "<h1>分享記錄 </h1>";
							echo $total;
							$sql_query1 = "select * from supply_goods_list where provider='".$id."' LIMIT 3;";
							$sql_query2 = "select * from supply_space_list where provider='".$id."' LIMIT 2;";
							$result = mysqli_query($db_conn,$sql_query1);
							$result2 = mysqli_query($db_conn,$sql_query2);
							echo "<ul class = 'polaroids'>";
							while($row = mysqli_fetch_array($result))
							{
								echo "<li><a href='supply_goods_detail2.php?id=".$row["id"]."' title='".$row['name']."'><img src= '".$row['image']."'></a></li>";
							}
							while($row = mysqli_fetch_array($result2))
							{
								echo "<li><a href='supply_space_detail2.php?id=".$row["id"]."' title='".$row['name']."'><img src= '".$row['image']."'></a></li>";
							}
							echo "</ul>";
						?>
					</div>
				</aside>
				
			</div>
		</div>
	</body>
</html>