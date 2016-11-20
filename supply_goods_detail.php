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
		
		<meta charset="UTF-8" />
		<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		
		<title>TbS</title>
        <link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/supply-item-detail-style.css" type="text/css" />
		<link id="noScriptCSS" rel="stylesheet" href="css/noscript.css">
		<script type="text/javascript" src="supply/jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" href="dist/zoomify.min.css">
		<script type="text/javascript"></script>
		<!--<link rel="stylesheet" type="text/css" href="button/css/default.css" />-->
		<link rel="stylesheet" type="text/css" href="button/css/component.css" />
		<script src="button/js/modernizr.custom.js"></script>
		<link rel="stylesheet" type="text/css" href="star/css/demo.css" />
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
		<script type="text/javascript" src="dropdown/js/jquery.js"></script>
		<script type="text/javascript">
$(document).ready(function(){

	$("#firstpane .menu_body:eq(0)").show();
	$("#firstpane .menu_body:eq(1)").hide();
	$("#firstpane .menu_body:eq(2)").hide();
	$("#firstpane h3.menu_head").click(function(){
		$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	
	$("#secondpane .menu_body:eq(0)").show();
	$("#secondpane h3.menu_head").mouseover(function(){
		$(this).addClass("current").next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
});
</script>
		<style type="text/css">
			.ban2{ width:250px; height:250px; position:relative; overflow:hidden; left:0;}
			.ban2 ul{ position:absolute; left:0; top:0;}
			.ban2 ul li{ width:500px; height:500px;padding:5px;}
			.prev1{ position:absolute; top:75px;<!--top:220px;--> left:0px; width:28px; height:51px;z-index:9;cursor:pointer;}
			.next1{ position:absolute; top:75px; right:0px; width:28px; height:51px;z-index:9;cursor:pointer;}
		</style>
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
        <script type="text/javascript" src="dropdown/js/jquery.js"></script>


<style type="text/css">
.menu_list{width:253px; }
.menu_head{
	height: 47px;
	line-height: 47px;
	padding-left: 80px;
	font-size: 18px;
	color: #525252;
	cursor: pointer;
	border: 1px solid #b3b3b3;
	/*border-right: 1px solid #808080;
	border-bottom: 1px solid #808080;
	border-top: 1px solid #808080;*/
	
	margin: 0px;
	font-weight: bold;
	background: white url(images/pro_left.png) center right no-repeat;
}
.menu_list .current{background:white url(images/pro_down.png) center right no-repeat;}
.menu_body{
	line-height: 20px;
	border-left: 1px solid #b3b3b3;
	backguound: #fff;
	border-right: 1px solid #b3b3b3;
	border-bottom: 1px solid #b3b3b3;
}
.menu_body a{display:block;height:auto;line-height:10px;color:#777777;background:#fff;text-decoration:none;}
.menu_body a:hover{text-decoration:none;}
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
				$sql_query = "select * from supply_goods_list a LEFT OUTER JOIN user_list b on a.provider = b.uid where a.id='".$id."';";
				$result = mysqli_query($db_conn,$sql_query);
				$row = mysqli_fetch_array($result);
				$email = $row['email'];
            ?></div>
		<div id = "sub-container">
			<div id="firstpane" class="menu_list">
				<h3 class="menu_head current">熱門推薦</h3>
				<div style="display:block" class="menu_body">
					<div class="ban " id="demo1">
					<div class="ban2 " id="ban_pic1" >
					<div class="prev1" id="prev1"><img src="single-slider/images/index_tab_l.png" width="28" height="51"  alt=""/></div>
					<div class="next1" id="next1"><img src="single-slider/images/index_tab_r.png" width="28" height="51"  alt=""/></div>
						<ul>
							<li><a href="javascript:"><img src="uploadfile/bbq.jpg" width="500" height="500" alt=""/><p>烤肉架</p></a></li>
							<li><a href="javascript:;"><img src="uploadfile/cloer.jpg" width="500" height="500" alt=""/><p>烤鬆餅機</p></a></li>
							<li><a href="javascript:;"><img src="uploadfile/skal.jpg" width="500" height="500" alt=""/><p>彩色酷炫滑板</p></a></li>
						</ul>
					</div>
					</div>
				</div>
	
				<h3 class="menu_head ">最多收藏</h3>
				<div style="display:block" class="menu_body">
					<div class="ban " id="d2">
					<div class="ban2 " id="ban_pic2" >
					<div class="prev1" id="prev2"><img src="single-slider/images/index_tab_l.png" width="28" height="51"  alt=""/></div>
					<div class="next1" id="next2"><img src="single-slider/images/index_tab_r.png" width="28" height="51"  alt=""/></div>
						<ul>
							<li><a href="javascript:;"><img src="uploadfile/skal.jpg" width="500" height="500" alt=""/><p>彩色酷炫滑板</p></a></li>
							<li><a href="javascript:"><img src="uploadfile/bbq.jpg" width="500" height="500" alt=""/><p>烤肉架</p></a></li>
							<li><a href="javascript:;"><img src="uploadfile/cloer.jpg" width="500" height="500" alt=""/><p>烤鬆餅機</p></a></li>
							
						</ul>
					</div>
					</div>
				</div>
				<h3 class="menu_head ">最新發佈</h3>
				<div style="display:block" class="menu_body">
					<div class="ban " id="d3">
					<div class="ban2 " id="ban_pic3" >
					<div class="prev1" id="prev3"><img src="single-slider/images/index_tab_l.png" width="28" height="51"  alt=""/></div>
					<div class="next1" id="next3"><img src="single-slider/images/index_tab_r.png" width="28" height="51"  alt=""/></div>
						<ul>
							
							<li><a href="javascript:;"><img src="uploadfile/cloer.jpg" width="500" height="500" alt=""/><p>烤鬆餅機</p></a></li>
							<li><a href="javascript:;"><img src="uploadfile/skal.jpg" width="500" height="500" alt=""/><p>彩色酷炫滑板</p></a></li>
							<li><a href="javascript:"><img src="uploadfile/bbq.jpg" width="500" height="500" alt=""/><p>烤肉架</p></a></li>
						</ul>
					</div>
					</div>
				</div>
			</div>
			<!--<div class="sub-content">
				<h2>熱門推薦</h2>
				<div class="ban" id="demo1">
					<div class="ban2" id="ban_pic1" >
					<div class="prev1" id="prev1"><img src="single-slider/images/index_tab_l.png" width="28" height="51"  alt=""/></div>
					<div class="next1" id="next1"><img src="single-slider/images/index_tab_r.png" width="28" height="51"  alt=""/></div>
						<ul>
							<li><a href="javascript:;"><img src="uploadfile/qqq.jpg" width="500" height="500" alt=""/></a></li>
							<li><a href="javascript:;"><img src="uploadfile/room.jpg" width="500" height="500" alt=""/></a></li>
							<li><a href="javascript:;"><img src="uploadfile/room2.jpg" width="500" height="500" alt=""/></a></li>
						</ul>
					</div>
				</div>
			</div>-->
		</div>
		<div id="ContentContainer">
			<!--<input id="back" type="button" onClick="history.back()" value="回到上一頁"></input>-->
                <div class="MainPage">
                <table id="ThisTable" border="0">
                
                	<tr>
                    	<th height="100" colspan="4" scope="row" ><h2 id="title"><?php echo $row["name"]?></h2><hr size="1" color="#b3b3b3"/></th>
                   	</tr>
                    <tr>
                    	<th id="imgbckcolor" style="text-align:center; width:20%;"  rowspan="11" scope="row">
							<div class="example image"><img src="<?php echo $row["image"]; ?>" class="img-rounded"/></div>
						</th>
                    	<th width="1%" rowspan="11" scope="row"></th>
                    	<td width="200" id="pp" style="border-top:0px solid white"><span style="color:#808080">用途/功能:&nbsp;&nbsp&nbsp;&nbsp;</span><?php echo $row["description"]?></td>
                    	<th width="35%" rowspan="10" scope="row" >
						<!--<div id="submit-dialog">-->
							<div class="owned">
							<?php
								if($row["picture"]==null)								{
									$pic = "img/selfie.png";
								}else{
									$pic = $row['picture'];
								}
								echo "<div class='provider-info'><p style='color:#666666;font-size:13pt;'>By-</p>";
								echo "<a href='user-profile.php?id=".$row["uid"]."' target='_blank'><p style='color:#666699;font-size:12pt;'>".$row["nickname"]."</p></a>";
								//echo "<div id ='demo3' class='demo' data-rate='2' data-ratemax='3'><span class='ratyli'></span></div>";
								echo "</div>";
								echo "<img class='provider-pic' src='$pic'>";
								echo "</div>";
							?>
                            <?php if(isset($_SESSION['user_id'])){ ?>
                            	<form action="<?php echo 'supply_trade_confirm.php?id='.$row['id'].'&type=goods' ?>" method="post" style="border:1px solid #e6e6e6;padding:20px;border-radius:5px;margin-top:-20px;background:#f2f2f2;">
									
                                	<textarea style="font-size:17px ;height:70px;width:100%;margin-bottom:5px;" name="message_demand" placeholder="如有需要請發送訊息給他/她" required></textarea>
									<button id="ThisConBtn">我有需要！！</button>
								</form>
                            <?php }else{ ?>
                            	<textarea style="font-size:17px ;height:70px;width:100%;margin-bottom:5px;" name="message_demand" placeholder="如有需要請先登入，以發送訊息給他/她" readonly></textarea>
								<button id="ThisConBtn" onclick="ToastUnlogin()">我有需要！！</button>
                            <?php } ?>
						<!--</div>-->
                        </th>
                    </tr>
                    <tr>
                    	<td><span style="color:#808080">品牌:&nbsp;&nbsp&nbsp;&nbsp;</span> <span ><?php echo $row["brand"]?></span></td>
                    </tr>
                    <tr>
                    	<td><span style="color:#808080">交易價格:&nbsp;&nbsp&nbsp;&nbsp;</span>NT$<?php echo $row["price"]?></td>
                    </tr>
                    <tr>
                    	<td><span style="color:#808080">數量:&nbsp;&nbsp&nbsp;&nbsp;</span><?php echo $row["quantity"]?> 個， 還需 <?php echo $row["rt_quantity"]?> 個</td>
                    </tr>
                    <tr>
                    	
                    </tr>
					<tr>
                    	<td><span style="color:#808080">加購配件:&nbsp;&nbsp&nbsp;&nbsp;</span><?php echo $row["add_purchase"]?></td>
                    </tr>
                    <tr>
                    	<td><span style="color:#808080">是否一次性物品:&nbsp;&nbsp&nbsp;&nbsp;</span><?php echo $row["once_time"]?></td>
                    </tr>
                    <tr>
                    	<td><span style="color:#808080">原有損壞的地方:&nbsp;&nbsp&nbsp;&nbsp;</span><?php echo $row["damaged_part"]?></td>
                    </tr>
                    <tr>
                    	<td><span style="color:#808080">是否要配件才可使用:&nbsp;&nbsp&nbsp;&nbsp;</span><?php echo $row["fitting"]?></td>
                    </tr>
                    
                    
				</table>
				<section id="btn-click">
                	<?php
						$sql_like = "select * from supply_list where s_type='goods' and s_id='".$id."';";
						$rs_like = mysqli_query($db_conn,$sql_like);
						$row_like = mysqli_fetch_array($rs_like);
					?>
					<p>
						<a href="#"><button class="btn btn-mark btn-3b icon-star-2">Bookmark</button></a>
						<a href="supply_item_like.php?id=<?php echo $id ?>&type=goods"><button class="btn btn-likes btn-3b icon-heart-2">Like (<?php echo $row_like['like_quantity']?>)</button></a>
					</p>
				</section>
                <div id="leaveMessage">
                    <h2>留言版<input id="msgBtn" type="button" value="+" onClick="if(document.getElementById('openmsg').style.display=='none'){document.getElementById('openmsg').style.display = 'block';document.getElementById('msgBtn').value='-';}else{document.getElementById('openmsg').style.display='none';document.getElementById('msgBtn').value='+';}" /></h2>
					<div id="openmsg" style="display:none;">
                        <div id="postMessage">
                            <?php if(isset($_SESSION['user_id'])){ ?>
                            <form action="<?php echo 'supply_message_insertdb.php?id='.$id.'&email='.$email.'&type=goods' ?>" method="post">    
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
                                        <td><button type="submit" style="margin-left:15px;" id="ThisBtn" onclick="ToastUnlogin()">確定送出</button></td>
                                    </tr>
                                </table>
                            <?php } ?>
                        </div>
                        <div id="message">
                            <?php
                                $sql_message = "select * from user_message a LEFT OUTER JOIN user_list b on a.message_uid = b.uid where s_type = 'goods' and supply = ".$id." order by message_date DESC";
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
	  	</div>
        <div id="this_footer">
			<?php require ("footer.php")?>
        </div> 
    </div>
    <script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.toast.js"></script>
    <script src="js/scriptsample.js"></script>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="js/script-scroll.js"></script>
	<script src="dist/zoomify.min.js"></script>
	<script src="button/js/classie.js"></script>
	<script type="text/javascript">
		$('.example img').zoomify();
	</script>
	<script src="single-slider/js/pic_tab.js"></script>

	<script type="text/javascript">
	jq('#demo1').banqh({
	box:"#demo1",//总框架
	pic:"#ban_pic1",//大图框架
	//pnum:"#ban_num1",//小图框架
	//prev_btn:"#prev_btn1",//小图左箭头
	//next_btn:"#next_btn1",//小图右箭头
	//pop_prev:"#prev2",//弹出框左箭头
	//pop_next:"#next2",//弹出框右箭头
	prev:".prev1",//大图左箭头
	next:".next1",//大图右箭头
	//pop_div:"#demo2",//弹出框框架
	//pop_pic:"#ban_pic2",//弹出框图片框架
	//pop_xx:".pop_up_xx",//关闭弹出框按钮
	mhc:".mhc",//朦灰层
	autoplay:true,//是否自动播放
	interTime:3000,//图片自动切换间隔
	delayTime:400,//切换一张图片时间
	pop_delayTime:400,//弹出框切换一张图片时间
	order:0,//当前显示的图片（从0开始）
	picdire:true,//大图滚动方向（true为水平方向滚动）
	//mindire:true,//小图滚动方向（true为水平方向滚动）
	//min_picnum:5,//小图显示数量
	pop_up:true//大图是否有弹出框
	
	})
	
	jq('#d2').banqh({
	box:"#d2",//总框架
	pic:"#ban_pic2",//大图框架
	prev:".prev1",//大图左箭头
	next:".next1",//大图右箭头
	mhc:".mhc",//朦灰层
	autoplay:true,//是否自动播放
	interTime:3000,//图片自动切换间隔
	delayTime:400,//切换一张图片时间
	pop_delayTime:400,//弹出框切换一张图片时间
	order:0,//当前显示的图片（从0开始）
	picdire:true,//大图滚动方向（true为水平方向滚动）
	pop_up:true//大图是否有弹出框
	
	})
	jq('#d3').banqh({
	box:"#d3",//总框架
	pic:"#ban_pic3",//大图框架
	prev:".prev1",//大图左箭头
	next:".next1",//大图右箭头
	mhc:".mhc",//朦灰层
	autoplay:true,//是否自动播放
	interTime:3000,//图片自动切换间隔
	delayTime:400,//切换一张图片时间
	pop_delayTime:400,//弹出框切换一张图片时间
	order:0,//当前显示的图片（从0开始）
	picdire:true,//大图滚动方向（true为水平方向滚动）
	pop_up:true//大图是否有弹出框
	
	})
	</script>
	</body>
</html>