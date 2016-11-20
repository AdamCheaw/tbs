<?php
require ("connMysql.php");
session_start();

$id=(int)$_GET['id'];
$provider = $_GET['provider'];
$type = $_GET['type'];
if($id<=0){
	echo "empty ID";
	exit(0);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>TbS</title>
	<link rel="shortcut icon" href="img/favicon.ico" />
	<link href="css/trade.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/supply_apply_style.css" type="text/css" />
    <script>
		function chg(){
			var obj = document.getElementById("trans_oth");
			if(trans.checked==true){
				$('.trans_oth').removeAttr("readonly");	
			}else if(trans.checked!=true){
				$('.trans_oth').attr("readonly","readonly");
				obj.value = "";
			}
		}
		function chg2_2(){
			if(fitting2.checked==true){
				$('.fitting_yes').removeAttr("readonly");
			}
		}
		function chg2_1(){
			var obj = document.getElementById("fitting_yes");
			if(fitting1.checked==true){
				$('.fitting_yes').attr("readonly","readonly");
				obj.value = "";	
			}	
		}
		function chg3_2(){
			if(advise2.checked==true){
				$('.advise_yes').removeAttr("readonly");
			}
		}
		function chg3_1(){
			var obj = document.getElementById("advise_yes");
			if(advise1.checked==true){
				$('.advise_yes').attr("readonly","readonly");
				obj.value = "";	
			}
		}
		function chg4_2(){
			if(mid2.checked==true){
				$('.mid_yes').removeAttr("readonly");
			}
		}
		function chg4_1(){
			var obj = document.getElementById("mid_yes");
			if(mid1.checked==true){
				$('.mid_yes').attr("readonly","readonly");
				obj.value = "";	
			}
		}
		function Schg(){
			var obj = document.getElementById("public_oth");
			if(public.checked==true){
				$('.public_oth').removeAttr("readonly");	
			}else if(public.checked!=true){
				$('.public_oth').attr("readonly","readonly");
				obj.value = "";
			}
		}
		function Schg2(){
			var obj = document.getElementById("fac_oth");
			if(facilities.checked==true){
				$('.fac_oth').removeAttr("readonly");	
			}else if(facilities.checked!=true){
				$('.fac_oth').attr("readonly","readonly");
				obj.value = "";
			}
		}
        </script>
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
			<div id="demand_trade">
            	<?php if($type == 'goods'){
                	$sql = "select * from demand_list where id='".$id."';";
                    $result = mysqli_query($db_conn,$sql);
                    $row = mysqli_fetch_array($result);
				?>
                    <fieldset><h1 class="ThisH1">我提供-物品上架</h1><hr/>
                    <form action="demand_trade_sGoodsDB.php?id=<?php echo $id?>&provider=<?php echo $provider?>" method="post" enctype="multipart/form-data">
                        <table class="ThisTable" border="0">
                        <tr >
                            <td class="formLeft">物品名稱:</td><td class="formRight"><input type="text" name="name" class="inputText" value="<?php echo $row['name']?>" disabled></td>
                        </tr>
                        <tr>
                            <td class="formLeft">類別:</td>
                            <td class="formRight">
                                <select name = "type2" class="inputSelect">
                                    <option value="3C">3C</option>
                                    <option value="wear">穿搭</option>
                                    <option value="book">書籍</option>
                                    <option value="kitchenware">廚具</option>
                                    <option value="furniture">家具</option>
                                    <option value="camp">露營</option>
                                    <option value="sport">運動</option>
                                    <option value="other">其他</option>
                                </select>
                            </td>
                        </tr>
                        <tr >
                            <td class="formLeft">功能:</td><td class="formRight" ><textarea name="description" class="inputTextArea"  placeholder="ex:適合拍攝影片" required><?php echo $row['description']?></textarea></td>
                        </tr>
                        <tr>
                            <td class="formLeft">品牌:</td><td class="formRight"><input type="text" name="brand" class="inputText" value="<?php echo $row['brand']?>" placeholder="如適用"></td>
                        </tr>
                        <tr>
                            <td class="formLeft">交易價格:</td><td class="formRight" >NT$ <input type="text" name="price" class="inputText" value="<?php echo $row['price']?>" required></td>
                        </tr>
                        <tr>
                            <td class="formLeft">數量:</td><td class="formRight"><input type="number" name="quantity" class="inputNumber" min="1" required> 個</td>
                        </tr>
                        <tr>
                            <td class="formLeft">原有損壞的地方:</td><td class="formRight"><textarea name="damaged_part" class="inputTextArea" placeholder="說明，描述"></textarea></td>
                        </tr>
                        <tr>
                            <td class="formLeft">是否要配件才可使用:</td>
                            <td class="formRight">
                                <label><input type="radio" name="fitting" id="fitting1" value="否" onClick="chg2_1()" required>否</label><br/>
                                <label><input  type="radio"  name="fitting" id="fitting2" value="是" onClick="chg2_2()" required>是</label><textarea name="fitting_yes" class="fitting_yes" id="fitting_yes" placeholder="配件是否加購，或是已經包含" readonly></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="formLeft">加購配件:</td><td class="formRight"><input type="text" name="add_purchase" class="inputText"></td>
                        </tr>
                        <tr>
                            <td class="formLeft" style="padding-right:25px;">物品圖片:</td>
                            <td class="formRight">
                                <input type="file" name="image" class="inputFile">
                                <div>
                                    <img class="preview" style="max-width: 150px; max-height:150px">
                                    <div class="size"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="formCenter" id="thisA" colspan="2">
                                <input type="radio" name="protocol" required>
                                同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                            </td>
                        </tr>
                      </table>
                      <div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
                    </form>
                    </fieldset>
            	<?php 
				}else if($type == 'service'){
                	$sql = "select * from demand_list where id='".$id."';";
                    $result = mysqli_query($db_conn,$sql);
                    $row = mysqli_fetch_array($result);
				?>
                	<fieldset><h1 class="ThisH1">我提供-服務上架</h1><hr/>
                    <form action="demand_trade_sServiceDB.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
                        <table class="ThisTable3" border="0">
                        <tr >
                            <td class="formLeft">服務名稱:</td><td class="formRight"><input type="text" name="name" class="inputText" value="<?php echo $row['name']?>" placeholder="ex:服務、代班" disabled></td>
                        </tr>
                        <tr>
                            <td class="formLeft">類別:</td>
                            <td class="formRight">
                                <select name = "type2" class="inputSelect">
                                    <option value="bytime">按時算</option>
                                    <option value="bypic">按件算</option>
                                    <option value="other">其他</option>
                                </select>
                            </td>
                        </tr>
                        <tr >
                            <td class="formLeft">日期與時間:</td><td class="formRight"><input type="datetime-local" name="service_time" class="inputDatetime" required></td>
                        </tr>
                        <tr>
                            <td class="formLeft">地點:</td><td class="formRight"><input type="text" name="location" class="inputText" required></td>
                        </tr>
                        
                        <tr>
                            <td class="formLeft">薪資計算:</td><td class="formRight"><input type="text" name="price" class="inputText" value="<?php echo $row['price']?>" placeholder="按時、按件數" required></td>
                        </tr>
                        <tr>
                            <td class="formLeft">工作內容:</td><td class="formRight"><textarea name="detail" class="inputTextArea" required><?php echo $row['description']?></textarea></td>
                        </tr>
                        <tr>
                            <td class="formLeft">技能需求:</td><td class="formRight"><textarea name="need_skill" class="inputTextArea" placeholder="ex:Excel、程式、財務"></textarea></td>
                        </tr>
                        
                        <tr>
                            <td class="formLeft">特別需求:</td><td class="formRight"><textarea name="special" class="inputTextArea" placeholder="自帶電腦、身穿黑色衣褲"></textarea></td>
                        </tr>
                        <tr>
                            <td class="formLeft">需求人數:</td><td class="formRight"><input type="number" name="num_ppl" class="inputNumber" min="1" required> 人</td>
                        </tr>
                        <tr>
                            <td class="formCenter" id="thisA" colspan="2">
                                <input type="radio" name="protocol" required>
                                同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                            </td>
                        </tr>
                        </table>
                        <div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
                    </form>
                    </fieldset>
                <?php 
				}else if($type == 'vehicle'){
                	$sql = "select * from demand_list where id='".$id."';";
                    $result = mysqli_query($db_conn,$sql);
                    $row = mysqli_fetch_array($result);
				?>
                	<fieldset><h1 class="ThisH1">我提供-共乘上架</h1><hr/>
                    <form action="demand_trade_sVehicleDB.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
                        <table class="ThisTable3" border="0">
                        <tr>
                            <td class="formLeft">類別:</td>
                            <td class="formRight">
                                <select name = "type2" class="inputSelect">
                                    <option value="car">汽車</option>
                                    <option value="motor">機車</option>
                                    <option value="other">其他</option>
                                </select>
                            </td>
                        </tr>
                        <tr >
                            <td class="formLeft">出發日期與時間:</td><td class="formRight"><input type="datetime-local" name="vehicle_date" class="inputDatetime" value="<?php echo $row["v_date"]?>" required></td>
                        </tr>
                        
                        <tr>
                            <td class="formLeft">目的地:</td><td class="formRight"><input type="text" name="destination" class="inputText" value="<?php echo $row['destination']?>" disabled></td>
                        </tr>
                        <tr>
                            <td class="formLeft">集合地點:</td><td class="formRight"><textarea name="meet_place" class="inputTextArea" required></textarea></td>
                        </tr>
                        <tr>
                            <td class="formLeft">費用:</td><td class="formRight"><input type="text" name="price" class="inputText" value="<?php echo $row['price']?>" placeholder="ex:300/人" required></td>
                        </tr>
                        
                        <tr>
                            <td class="formLeft">共乘人數:</td><td class="formRight"><input type="number" name="num_ppl" class="inputNumber" placeholder="乘客的人數" min="1" required> 人</td>
                        </tr>
                        <tr>
                            <td class="formLeft">車子的款式:</td><td class="formRight"><textarea name="vehicle_brand" class="inputTextArea" placeholder="ex:豐田xx"></textarea></td>
                        </tr>
                        <tr>
                            <td class="formLeft">途徑的道路:</td><td class="formRight"><input type="text" name="road" class="inputText" placeholder="ex:國六/國一/台16"></td>
                        </tr>
                        <tr>
                            <td class="formLeft">是否接受中途下車:</td>
                            <td class="formRight">
                                <label><input type="radio" name="mid_getoff" id="mid1" onClick="chg4_1()" value="否">否</label><br/>
                                <label><input type="radio"  name="mid_getoff" id="mid2" value="是" onClick="chg4_2()" required>是</label><textarea name="mid_yes" class="mid_yes" id="mid_yes" placeholder="ex:去彰化的車，可以在台中下車" readonly></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="formLeft">備註:</td><td class="formRight"><textarea name="remind" class="inputTextArea" ></textarea></td>
                        </tr>
                        <tr>
                            <td class="formCenter" id="thisA" colspan="2">
                                <input type="radio" name="protocol" required>
                                同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                            </td>
                        </tr>
                        </table>
                        <div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
                    </form>
                    </fieldset>
                <?php 
				}else if($type == 'space'){
                	$sql = "select * from demand_list where id='".$id."';";
                    $result = mysqli_query($db_conn,$sql);
                    $row = mysqli_fetch_array($result);
				?>
                	<fieldset><h1 class="ThisH1">我提供-空間上架</h1><hr/>
                    <form  action="demand_trade_sSpaceDB.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
                        <table class="ThisTable3" border="0">
                        <tr >
                            <td class="formLeft">空間名稱:</td><td class="formRight"><input type="text" name="name" class="inputText" value="<?php echo $row['name']?>" placeholder="ex:小型開會空間" disabled></td>
                        </tr>
                        <tr>
                            <td class="formLeft">類別:</td>
                            <td class="formRight">
                                <select name = "type2" class="inputSelect">
                                    <option value="stay">住宿</option>
                                    <option value="store">儲藏</option>
                                    <option value="other">其他</option>
                                </select>
                            </td>
                        </tr>
                        <tr >
                            <td class="formLeft">地點:</td><td class="formRight"><input type="text" name="location" class="inputText" placeholder="ex:管院 R103" required></td>
                        </tr>
                        
                        <tr>
                            <td class="formLeft">大小:</td><td class="formRight"><textarea name="size" style="padding-bottom:15px;" class="inputTextArea" placeholder="說明，坪數、大小、或以人數容量概估，ex：4坪、可容納4人" required></textarea></td>
                        </tr>
                        <tr>
                            <td class="formLeft">建議使用人數:</td><td class="formRight"><input type="text" name="num_ppl" class="inputText" value="<?php echo $row['price']?>" placeholder="ex:3~5人" required></td>
                        </tr>
                        <tr>
                            <td class="formLeft">價格:</td><td class="formRight"><input type="text" name="price" class="inputText" placeholder="ex:以天計算、以時計算" required></td>
                        </tr>
                        <tr>
                            <td class="formLeft">使用期限:</td>
                            <td class="formRight">
                                開始：<input type="date" class="inputDate" name="d_start" required><br/>
                                結束：<input type="date" class="inputDate" name="d_stop" required>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="formLeft">空間內設備:</td>
                            <td class="formRight">
                                <label><input type="checkbox" name="facilities[]" value="電視" required>電視</label>
                                <label><input type="checkbox" name="facilities[]" value="電腦" required>電腦</label>
                                <label><input type="checkbox" name="facilities[]" value="投影機" required>投影機</label><br/>
                                <label><input type="checkbox" name="facilities[]" value="印表機" required>印表機</label>
                                <label><input type="checkbox" name="facilities[]" value="冷氣" required>冷氣</label>
                                <label><input type="checkbox" name="facilities[]" value="電風扇" required>電風扇</label><br/>
                                <label><input type="checkbox" name="facilities[]" value="冰箱" required>冰箱</label>
                                <label><input type="checkbox" name="facilities[]" value="儲物櫃" required>儲物櫃</label>
                                <label><input type="checkbox" name="facilities[]" value="網絡" required>網絡</label><br/>
                                <label><input type="checkbox" name="facilities[]" value="桌子" required>桌子</label>
                                <label><input type="checkbox" name="facilities[]" value="室內廁所" required>椅子</label><br/>
                                <label><input type="checkbox" name="facilities[]" id="facilities" value="其他" onClick="Schg2()" required>其他:</label><textarea name="fac_oth" class="fac_oth" id="fac_oth" cols="50" rows="1" readonly></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="formLeft">附設設備收費:</td><td class="formRight"><textarea name="fac_with" class="inputTextArea" placeholder="ex:冷氣(NT$5/per hour)"></textarea></td>
                        </tr>
                        <tr>
                            <td class="formLeft">空間圖片:</td>
                            <td class="formRight">
                                <input type="file" name="image" class="inputFile">
                                <div>
                                    <img class="preview" style="max-width: 150px; max-height:150px">
                                    <div class="size"></div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="formCenter" id="thisA" colspan="2">
                                <input type="radio" name="protocol" required>
                                同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                            </td>
                        </tr>
                        </table>
                        <div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
                    </form>
                    </fieldset>
            	<?php }?>
			</div>
		</div>
	</div>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script>
		$(function(){
			var requiredCheckboxes = $(':checkbox[required]');
		    requiredCheckboxes.change(function(){
				if(requiredCheckboxes.is(':checked')) {
					requiredCheckboxes.removeAttr('required');
				}
				else {
					requiredCheckboxes.attr('required', 'required');
				}
			});
		});
	</script>
	<script>
		$(function (){
			function format_float(num, pos){
				var size = Math.pow(10, pos);
				return Math.round(num * size) / size;
			}
			function preview(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						$('.preview').attr('src', e.target.result);
						var KB = format_float(e.total / 1024, 2);
						$('.size').text("檔案大小：" + KB + " KB");
					}
					reader.readAsDataURL(input.files[0]);
				}
			}
			$("body").on("change", ".inputFile", function (){
				preview(this);
			})
		})
	</script>
</body>
</html>