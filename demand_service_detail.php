<?php
session_start();
require ("connMysql.php");
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
		<link rel="stylesheet" href="css/supply-item-detail-style.css" type="text/css" />
		<link id="noScriptCSS" rel="stylesheet" href="css/noscript.css">
		<script type="text/javascript" src="supply/jquery-1.10.2.min.js"></script>
		<script type="text/javascript"></script>
		<link rel="stylesheet" href="dist/zoomify.min.css">
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
		<style type="text/css">
			.MainPage{margin:20px;}
			#ContentContainer{border: 0px solid black;width:800px;position:relative;left:260;top:20;}
		</style>
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
            	$sql_query = "select * from demand_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				$result = mysqli_query($db_conn,$sql_query);
				$row = mysqli_fetch_array($result);
				$email = $row['email'];
			?></div>
		<div id="ContentContainer">
            <div class="MainPage">
                
				<table id="ThisTable" border="0">
                    <tr>
                        <th height="100" colspan="9" scope="row" ><h2 id="title"><?php echo $row["name"]?></h2><hr size="1" color="#b3b3b3"/></th>
                    </tr>
                    <tr>
                        <th id="imgbckcolor" style="text-align: center;vertical-align:top;" width="300" height="200" rowspan="10" scope="row">
                            <div class="example"><img src="<?php echo $row["picture"]; ?>" class="img-rounded"/></div><h3><?php echo $row["nickname"]?><small>發佈了需求</small></h3>
                        </th>
                        <th width="0" rowspan="10" scope="row"></th>
                        <td width="400" id="pp" style="border-top:0px solid white"></td>
                        <th width="0" rowspan="10" scope="row"></th>
                    </tr>
					<tr>
						<td width="4">
							<div id="adjust">
							<p>發帖時間： <?php echo date('d M Y',strtotime($row["post_date"]));?></p>
							<p>需要的時間：<?php echo date('d M Y',strtotime($row["need_date"]));?> 前</p>
							
							<p>願意支付的價格 : <?php echo $row["price"]?></p>
							<p>描述 : <?php echo $row["description"]?></p>
							<?php echo "<a href='demand_trade_login.php?id=".$row["id"]."&provider=".$row["provider"]."'><div id='ThisDBtn'>我想提供</div></a>" ?>
							</div>
						</td>
						
					</tr>
					
                   
				</table>
                <div id="leaveMessage">
                	<h2>留言版<input id="msgBtn" type="button" value="+" onClick="if(document.getElementById('openmsg').style.display=='none'){document.getElementById('openmsg').style.display = 'block';document.getElementById('msgBtn').value='-';}else{document.getElementById('openmsg').style.display='none';document.getElementById('msgBtn').value='+';}" /></h2>
					<div id="openmsg" style="display:none;">
                        <div id="postMessage">
                            <?php 
                                if(isset($_SESSION['user_id'])){
                            ?>
                            <form action="<?php echo 'demand_message_insertdb.php?id='.$id.'&email='.$email.'' ?>" method="post">    
                                <table>
                                    <tr>
                                        <td>我要留言：</td><td><textarea name="message_content" required></textarea></td>
                                        <td ><input type="submit" style="margin-left:15px;" id="ThisBtn" value="確定送出"></td>
                                    </tr>
                                </table>
                            </form>
                            <?php 
                                }else{
                            ?>
                                <table>
                                    <tr>
                                        <td>我要留言：</td><td><textarea name="message_content" id="pmLogin" placeholder="您還未登入，登入後可進行留言" required></textarea></td>
                                    </tr>
                                </table>
                            <?php
                                }
                            ?>
                        </div>
                        <div id="message">
                            <?php
                                $sql_message = "select * from user_message a LEFT OUTER JOIN user_list b on a.message_uid = b.uid where demand = ".$id." order by message_date DESC ";
                                $result_message = mysqli_query($db_conn,$sql_message);
                                while($row_m = mysqli_fetch_array($result_message)){
                            ?>
                                    <table id="mTable">
                                    <tr>
                                      <td id="img" rowspan="2"><?php echo "<img id='img2' src=".$row_m['picture'].">" ?></td>
                                      <td style="float:left;"><?php echo $row_m['nickname']?></td>
                                      <td style="float:right;">留言時間：<?php echo date('Y年m月d日 g:ia',strtotime($row_m['message_date']))?></td>
                                    </tr>
                                    <tr>
                                      <td  colspan="2"><?php echo $row_m['message_content']?></td>
                                    </tr>
                                    </table>
                            <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
			</div>
	  	</div>
        <div id="this_footer">
			<?php require ("footer.php")?>
        </div>
    </div>
	<script src="js/jquery.socialbutton-1.9.1.js"></script>
    <script src="js/scriptsample.js"></script>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="js/script-scroll.js"></script>
	<script src="dist/zoomify.min.js"></script>
	<script type="text/javascript">
		$('.example img').zoomify();
	</script>
    <script src="js/libs_useso.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.toast.js"></script>
	</body>
</html>