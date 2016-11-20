<?php
session_start();
require ("connMysql.php");
$id=(int)$_GET['id'];
if($id<=0){
	echo "empty ID";
	exit(0);
}
?>
<html lang="zh">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>TbS</title>
		<script type="text/javascript" src="supply/jquery-1.10.2.min.js"></script>
        <link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/test.css" type="text/css" />
		<link id="noScriptCSS" rel="stylesheet" href="css/noscript.css"/>
		<link rel="stylesheet" type="text/css" href="dist/zoomify.min.css"/>
		<!--<link rel="stylesheet" type="text/css" href="button/css/default.css" />-->
		<link rel="stylesheet" type="text/css" href="button/css/component.css" />
		<link rel="stylesheet" href="hdialog/css/common.css"/><!-- 页面基本样式 -->
		
		<style type="text/css">
			#demo1{margin-top:5px;}
			*{ margin:0; padding:0; list-style:none;}
			.ban2{ width:250px; height:230px; position:relative; overflow:hidden; left:0;}
			.ban2 ul{ position:absolute; left:0; top:0;}
			.ban2 ul li{ width:300px; height:250px;}
			.ban2 ul li img{width:250px;height:210px;}
			.ban2 ul li p{padding:0 5px 5px 5px;}
			.prev1{ position:absolute; top:100px;<!--top:220px;--> left:20px; width:28px; height:51px;z-index:9;cursor:pointer;}
			.next1{ position:absolute; top:100px; right:0px; width:28px; height:51px;z-index:9;cursor:pointer;}
		</style>
		
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
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
            	$sql_query = "select * from supply_space_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				$result = mysqli_query($db_conn,$sql_query);
				$row = mysqli_fetch_array($result);
				$email = $row['email'];
			?></div>
		<div id = "sub-container">
			<div class="sub-content" >
				<h2>熱門推薦</h2>
				<hr/>
				<div style="display:block" class="menu_body">
				<div class="ban" id="demo1">
					<div class="ban2" id="ban_pic1" >
					<div class="prev1" id="prev1"><img src="single-slider/images/index_tab_l.png" width="28" height="51"  alt=""/></div>
					<div class="next1" id="next1"><img src="single-slider/images/index_tab_r.png" width="28" height="51"  alt=""/></div>
						<ul>
                        <?php
							$sql_loop = "select * from supply_space_list a LEFT OUTER JOIN supply_list b on a.id = b.s_id where s_type='space' order by like_quantity DESC limit 10";
							$rs_loop = mysqli_query($db_conn,$sql_loop);
							while($row_loop = mysqli_fetch_array($rs_loop)){
								if($row_loop['s_status'] == 'on' && $row_loop['like_quantity'] != '0'){
									if($row_loop["image"] != 'uploadfile/itemicon.png'){
										echo "<li><p>".$row_loop['name']."</p><a href='supply_space_detail2.php?id=".$row_loop["id"]."'><img src='".$row_loop['image']."' width='250' height='230'></a></li>";
									}
								}
							}
						?>
						</ul>
					</div>
				</div>
				</div>
			</div>
			<div class="sub-content2">
				<form action="search_space_list.php" id="search_box" method="post">
					<div class="search-wrapper">
						<input type="text" id="search" name="search" placeholder="搜索" />
						<input type="hidden" name="action" value="searching" />
						<button type="submit" class="search_btn"><img src="img/search_icon.png" title="Search" /></button>
					</div>
                </form>
				<div class="menu">             
					<div><a href="supply_space_list.php?type2=all"><img src="img/flag.png"/>最新發佈</a></div>
					<div><a href="supply_space_list.php?type2=bookmark"><img src="img/like.png"/>最多收藏</a></div>
					<div><a href="supply_space_list.php?type2=like"><img src="img/star.png"/>最多按贊</a></div>              
				</div>
			</div>
		</div>	
		<div id="contentContainer">
			<div class="MainPage">
				<h1><?php echo $row["name"]?></h1>
				<hr/>
				
				<div class="MainContent">
				<div class="prod-img">
					<div class="example"><img src="<?php echo $row["image"]; ?>" class="img-rounded" width="250" height="220" alt=""/></div>
				</div>
				<div class="prod-info">
				<table border="0">
					<tr>
						<td class="form-left">地點 : </td><td><?php echo $row["location"]?></td>
					</tr>
					<tr>
						<td class="form-left">大小 : </td><td><?php echo $row["space_size"]?></td>
					</tr>
					<tr>
						<td class="form-left">建議使用人數 : </td><td><?php echo $row["num_ppl"]?></td>
					</tr>
					<tr>
						<td class="form-left">價格 : </td><td><?php echo $row["price"]?></td>
					</tr>
					<tr>
						<td class="form-left">使用期限 : </td><td><?php echo date('d/m/Y',strtotime($row["space_start"]))?> 至 <?php echo date('d/m/Y',strtotime($row["space_stop"]))?></td>
					</tr>
					<tr>
						<td class="form-left">空間內附設備 : </td><td><?php echo $row["public_fac"]?></td>
					<tr/>
					<tr>
						<td class="form-left">附設設備收費 : </td><td><?php echo $row["fac_with"]?></td>
					<tr/>
				</table>
				</div>
				</div>
				<section id="btn-click">
					<?php
						$sql_like = "select * from supply_list where s_type='space' and s_id='".$id."';";
						$rs_like = mysqli_query($db_conn,$sql_like);
						$row_like = mysqli_fetch_array($rs_like);
					?>
					<p>
						<a href="supply_bookmark_like.php?id=<?php echo $id ?>&type=space&bl=bookmark"><button class="btn btn-mark btn-3b icon-star-2">Bookmark</button></a>
						<a href="supply_bookmark_like.php?id=<?php echo $id ?>&type=space&bl=like"><button class="btn btn-likes btn-3b icon-heart-2">Like [<?php echo $row_like['like_quantity']?>]</button></a>
					</p>
				</section>
				<div id="leaveMessage">
                	<h2>留言版<input id="msgBtn" type="button" value="+" onClick="if(document.getElementById('openmsg').style.display=='none'){document.getElementById('openmsg').style.display = 'block';document.getElementById('msgBtn').value='-';}else{document.getElementById('openmsg').style.display='none';document.getElementById('msgBtn').value='+';}" /></h2>
					<div id="openmsg" style="display:none;">
                        <div id="postMessage">
                            <?php if(isset($_SESSION['user_id'])){ ?>
                            <form action="<?php echo 'supply_message_insertdb.php?id='.$id.'&email='.$email.'&type=space' ?>" method="post">    
                                <table>
                                    <tr>
                                        <td>我要留言：</td><td><textarea name="message_content" required></textarea></td>
                                        <td><input type="submit" style="margin-left:15px;" id="ThisBtn" value="確定送出"></td>
                                    </tr>
                                </table>
                            </form>
                            <?php }else{ ?>
                                <table>
                                    <tr>
                                        <td>我要留言：</td><td><textarea name="message_content" id="pmLogin" placeholder="您還未登入，登入後可進行留言" readonly></textarea></td>
                                        <td><button type="submit" style="margin-left:15px;" id="ThisBtn" onClick="ToastUnlogin()">確定送出</button></td>
                                    </tr>
                                </table>
                            <?php } ?>
                        </div>
                        <div id="message">
                            <?php
                                $sql_message = "select * from user_message a LEFT OUTER JOIN user_list b on a.message_uid = b.uid where s_type = 'space' and supply = ".$id." order by message_date DESC";
                                $result_message = mysqli_query($db_conn,$sql_message);
                                while($row_m = mysqli_fetch_array($result_message)){
                            ?>
                                    <table id="mTable">
                                    <tr>
                                      <td id="img" rowspan="2"><?php echo "<img id='img2' src=".$row_m['picture'].">" ?></td>
                                      <td style="float:left;font-weight:bold;color:#666699;"><?php echo $row_m['nickname']?></td>
                                      <td style="float:right;font-size:10pt;">留言時間：<?php echo date('Y年m月d日 g:ia',strtotime($row_m['message_date']))?></td>
                                    </tr>
                                    <tr>
                                      <td  colspan="2" style="font-size:15pt;"><?php echo $row_m['message_content']?></td>
                                    </tr>
                                    </table>
                            <?php
                                }
                            ?>
                        </div>
                	</div>
                </div>
			</div>
			<div class="sideContent">
			<div id="ad">
				<img src ="img/adver2.jpg"/>
			</div>
			<div class="owned">
				<h3>提供者</h3>
				<hr color="#527a7a" />
				<?php
					if($row["picture"]==null){
					    $pic = "img/selfie.png";
					}else{
						$pic = $row['picture'];
					}
				?>
				<img class='provider-pic' src="<?php echo $pic ?>"/><p class="p-info">by- <?php echo "<a href='user-profile.php?id=".$row["uid"]."' target='_blank'>".$row["nickname"]."</a>"; ?></p>
				<form action="<?php echo 'supply_trade_confirm.php?id='.$row['id'].'&type=space' ?>" method="post">
									
                    <input name="id" type="hidden" value="<?php echo $row['id']; ?>">
					<input name="provider" type="hidden" value="<?php echo $row['provider']; ?>">
					<input name="type" type="hidden" value="space">
					<button id="ThisConBtn"><img src="img/hand.png"/>我想要</button>
				</form>
			</div>
			</div>
			
		</div>
        <!--<div id="this_footer">
			<?php require ("footer.php")?>
        </div>-->
    </div>
	<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="single-slider/js/pic_tab.js"></script>
	<script src="dist/zoomify.min.js"></script>
	<script type="text/javascript">
		$('.example img').zoomify();
	</script>
	<script type="text/javascript">
	jq('#demo1').banqh({
	box:"#demo1",//总框架
	pic:"#ban_pic1",//大图框架
	pnum:"#ban_num1",//小图框架
	prev_btn:"#prev_btn1",//小图左箭头
	next_btn:"#next_btn1",//小图右箭头
	pop_prev:"#prev2",//弹出框左箭头
	pop_next:"#next2",//弹出框右箭头
	prev:"#prev1",//大图左箭头
	next:"#next1",//大图右箭头
	pop_div:"#demo2",//弹出框框架
	pop_pic:"#ban_pic2",//弹出框图片框架
	pop_xx:".pop_up_xx",//关闭弹出框按钮
	mhc:".mhc",//朦灰层
	autoplay:true,//是否自动播放
	interTime:5000,//图片自动切换间隔
	delayTime:400,//切换一张图片时间
	pop_delayTime:400,//弹出框切换一张图片时间
	order:0,//当前显示的图片（从0开始）
	picdire:true,//大图滚动方向（true为水平方向滚动）
	mindire:true,//小图滚动方向（true为水平方向滚动）
	min_picnum:5,//小图显示数量
	pop_up:true//大图是否有弹出框
	})
	</script>
	
	</body>
</html>