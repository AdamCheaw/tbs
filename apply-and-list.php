<?php 
session_start();
include("connMysql.php");
?>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
		<title>TbS</title>
        <link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/apply-style.css" type="text/css" />
		<link id="noScriptCSS" rel="stylesheet" href="css/noscript.css">
		<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
		<script type="text/javascript"></script>
	</head>	
	<body>
	<div id="wrapper">
    	<div id="headerTopicContainer"></div>
			<div id="header">
			<?php 
				if(!isset($_SESSION['user_id'])){
					require ("header.php");
            	}else{
					require ("header_login.php");
				}
            ?></div>
		<div id="form">
		<fieldset>
		<h1>提出你的需求吧！！</h1>
		<hr/>
        <div id = "form-control" >
			<form action="insert_demand_list_db.php" method="post" name="formAdd" id="formAdd">
			<table id="table-content" border="0">
				<tr>
					<th class="form-left"><label for="name" >你需要什麼？</label></th>
					<th class="form-right"><input type="text" class="col-6" id="name" name="name" placeholder="標題.."></th>
				</tr>
				<tr>
					<th class="form-left"><label for="category">項目</label></th>
					<th class="form-right">
					<select class="select-class" id = "type" name="type">
					<option value="">請選擇</option>
					<option value="物品">物品</option>
					<option value="服務">服務</option>
					<option value="空間">空間</option>
					</select>
					</th>
				</tr>
				<tr>
					<th class="form-left"><label for="days">你預計要提出多少天？</label></th>
					<th class="form-right">
					<select class="select-class" id = "post_to" name="post_to">
					<option value="">請選擇</option>
					<option value="1">1天</option>
					<option value="2">2天</option>
					<option value="3">3天</option>
					<option value="4">4天</option>
					<option value="5">5天</option>
					<option value="6">6天</option>
					<option value="7">7天</option>
					</select>
					</th>
				</tr>
				<tr>
					<th class="form-left"><label for="description" >描述你的需求</label></th>
					<th class="form-right"><input type="textarea" class="col-9" id="description" name="description" placeholder="我需要....（盡量詳細一點哦！）"/></th>
				</tr>
				<tr>
					<th colspan="2">
						<input name="action" type="hidden" value="add">
						<input type="button" name="button-apply" id="button-apply" onClick="checkLogin()" value="送出">
					</th>
				</tr>
			</table>
			</form>
		</div>
		</fieldset>	
		</div>
		<div id="ShowContent">
		<?php
			//echo "<div id='ShowContent'>";
			if($goods_num > 0){
				echo "<p>符合( ".$title." )的搜尋結果共".$goods_num."筆</p>";
				//require ("supply_list_show.php");
				$result = mysqli_query($db_conn,$sql_query);
				while($row = mysqli_fetch_array($result))
				{
					echo "<table id='TableContent'>";
						echo "<tr>";
					        echo "<th height='150' colspan='3' scope='row'><div id='pic'><a href='goods_detail.php?id=".$row["id"]."'><img src='".$row["image"]."'><p id='prices'>NT$ ".number_format($row["price"])."</p></div></a></th>";
	 				    echo "</tr>";
						echo "<tr>";			
							echo "<th width='70' height='100' rowspan='2' scope='row'>頭像</th>";
							echo "<th id='information' width='180' height='100' colspan='2' scope='row'>";
								echo "<h2>".$row["name"]."</h2>";
								echo "<p>提供者：".$row["provider"]."</p>";
								echo "<p>發帖時間：".date('d M Y',strtotime($row["post_date"]))."</p>";
								echo "</th>";
						echo "</tr>";
					echo "</table>";
				}
			}
			else if($service_num > 0)
			{
				echo "<p>符合( ".$title." )的搜尋結果共".$service_num."筆</p>";
				$result = mysqli_query($db_conn,$sql_query2);
				while($row = mysqli_fetch_array($result))
				{
					echo "<table id='TableContent'>";
						echo "<tr>";
							echo "<th height='150' colspan='3' scope='row'><div id='pic'><a href='service_detail.php?id=".$row["id"]."'><img src='".$row["image"]."'><p id='prices'>費用 ".$row["price"]."</p></div></a></th>";
						echo "</tr>";
						echo "<tr>";
							echo "<th width='70' height='100' rowspan='2' scope='row'>頭像</th>";
							echo "<th id='information' width='180' height='100' colspan='2' scope='row'>";
								echo "<h2>".$row["name"]."</h2>";
								echo "<p>提供者：".$row["provider"]."</p>";
								echo "<p>發帖時間：".date('d M Y',strtotime($row["post_date"]))."</p>";
								echo "</th>";
						echo "</tr>";
					echo "</table>";
			    }
			}
			else if($space_num > 0)
			{
				echo "<p>符合( ".$title." )的搜尋結果共".$space_num."筆</p>";
				$result = mysqli_query($db_conn,$sql_query3);
				while($row = mysqli_fetch_array($result))
				{
					echo "<table id='TableContent'>";
						echo "<tr>";
							echo "<th height='150' colspan='3' scope='row'><div id='pic'><a href='space_detail.php?id=".$row["id"]."'><img src='".$row["image"]."'><p id='prices'>".$row["price"]."</p></div></a></th>";
						echo "</tr>";
						echo "<tr>";
							echo "<th width='70' height='100' rowspan='2' scope='row'>頭像</th>";
							echo "<th id='information' width='180' height='100' colspan='2' scope='row'>";
								echo "<h2>".$row["name"]."</h2>";
								echo "<p>提供者：".$row["provider"]."</p>";
								echo "<p>發帖時間：".date('d M Y',strtotime($row["post_date"]))."</p>";
								echo "</th>";
						echo "</tr>";
					echo "</table>";
			    }
			}
			
			//echo "</div>";
		?>
		</div>
        <div id="this_footer">
			<?php require ("footer.php")?>
        </div>  
	</div>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="js/script-scroll.js"></script>
	</body>
</html>