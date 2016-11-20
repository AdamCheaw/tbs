<?php
require ("connFB.php");

if(isset ($_SESSION['cantResetPass'])){
	unset($_SESSION['cantResetPass']);
	echo "<script>alert('無效的鏈接');</script>";	
}

?>
<!DOCTYPE html>
<html>
<head>
	<style>
		#header-nav a{cursor:pointer;}
		.hide_box{width:400px;color:#fff;color:#444;background:#fff;box-shadow:5px 5px 5px black;display:none;font-family:  Microsoft JhengHei ;padding:0;}
		.hide_box h4{height:40px;line-height:40px;overflow:hidden;background:#6ca1a1;color:#fff;padding:0 10px;font-size:25px;font-weight:bold;margin-top:0px;border-radius:10px 10px 0 0;}
		.hide_box h4 a{width:20px;line-height:20px;_line-height:15px;height:20px;font-family:arial;overflow:hidden;display:block;background:#fff;color:#808080;float:right;text-align:center;text-decoration:none;margin-top:7px;font-size:20px;font-weight:normal;border-radius:2px;_font-size:12px;}
		.hide_box p{padding:30px 10px;font-size:13px;border:1px solid #ccc;}
	</style>
	<link href="css/header.css" rel="stylesheet" type="text/css"/>
	<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>-->
    <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
</head>

<body>
<div id="header-inner">
    <div id="logo">
        <a href="demand.php"><img src="img/logo.png" /></a>
    </div>
    <ul id="header-nav">
        <li><a href="#" onclick="Toast()">幫助</a></li>
        <li><a id="demoBtn1">登入 / 註冊</a></li>
    </ul>
    
    
</div>
<script>
	var $ = function(){
		return document.getElementById(arguments[0]);
	};
	$('demoBtn1').onclick = function(){
		easyDialog.open({
			container : 'testBox',
			isOverlay : true,
			fixed : true
		});
	};
	$('testBox').getElementsByTagName('a')[0].onclick = function(){
		easyDialog.close();
	}
</script>
<script type="text/javascript">
	function ToastUnlogin(){
		$.toast({
			text: "尚未登入!!登入後才可點選", // Text that is to be shown in the toast
			heading: 'Login', // Optional heading to be shown on the toast
			icon: 'error', // Type of toast icon
			showHideTransition: 'slide', // fade, slide or plain
			allowToastClose: true, // Boolean value true or false
			hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
			stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
			position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
			textAlign: 'left',  // Text alignment i.e. left, right or center
			loader: true,  // Whether to show loader or not. True by default
			loaderBg: '#9ec600',  // Background color of the toast loader
		});
	}
</script>
<?php
	if(isset ($_SESSION['adyActive'])){
	unset($_SESSION['adyActive']);
?>
	<script type="text/javascript">
		function Toast(){
			$.toast({
				text: "您的帳號已被激活！", // Text that is to be shown in the toast
				heading: '', // Optional heading to be shown on the toast
				icon: 'success', // Type of toast icon
				showHideTransition: 'slide', // fade, slide or plain
				allowToastClose: true, // Boolean value true or false
				hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
				stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
				position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
				textAlign: 'left',  // Text alignment i.e. left, right or center
				loader: true,  // Whether to show loader or not. True by default
				loaderBg: '#9ec600',  // Background color of the toast loader
			});
		}window.onload= Toast;
	</script>
<?php } ?>
<?php 
	if(isset($_SESSION['unLoginForBL'])){
		unset($_SESSION['unLoginForBL']);
?>
	<script type="text/javascript">
		function Toast(){
			$.toast({
				text: "尚未登入!!登入後才可點選", // Text that is to be shown in the toast
				heading: 'Login', // Optional heading to be shown on the toast
				icon: 'error', // Type of toast icon
				showHideTransition: 'slide', // fade, slide or plain
				allowToastClose: true, // Boolean value true or false
				hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
				stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
				position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
				textAlign: 'left',  // Text alignment i.e. left, right or center
				loader: true,  // Whether to show loader or not. True by default
				loaderBg: '#9ec600',  // Background color of the toast loader
			});
		}window.onload= Toast;
	</script>
<?php }?>
<?php
	if(isset ($_SESSION['logout'])){
	unset($_SESSION['logout']);
?>
	<script type="text/javascript">
		function Toast(){
			$.toast({
				text: "您已成功登出", // Text that is to be shown in the toast
				heading: 'Logout', // Optional heading to be shown on the toast
				icon: 'warning', // Type of toast icon
				showHideTransition: 'slide', // fade, slide or plain
				allowToastClose: true, // Boolean value true or false
				hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
				stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
				position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
				textAlign: 'left',  // Text alignment i.e. left, right or center
				loader: true,  // Whether to show loader or not. True by default
				loaderBg: '#9ec600',  // Background color of the toast loader
			});
		}window.onload= Toast;
	</script>
<?php } ?>
<div class="hide_box" id="testBox"> 

<div id="login-form">
		<h4><a href="javascript:void(0)" title="关闭窗口">&times;</a>用戶登入</h4> 
          <table>
          <form action="login.php?token=0" method="post" enctype="multipart/form-data">
                <tr>
                  <td>帳號：</td><td><input type="text" name="email" class="inputText" placeholder="s123456789@ncnu.edu.tw" required/></td>
                </tr>
                <tr>
                  <td>密碼：</td><td><input type="password" name="password" class="inputText" required></td>
                </tr>
                <tr>
                  <td colspan="2"><input type="submit" class="ubutton" value="登入"></td>
                </tr>
            </form>
                <tr>
                  <td colspan="2" id="thisSub"><div class="subTitle"><a href="register_page.php">帳戶註冊</a></div><div class="subTitle"><a href="forget_pass_page.php">忘記密碼?</a></div></td>
                </tr>
                <tr>
                  <td colspan="2"><div id="thisOr">——————— OR ———————</div></td>
                </tr>
                <tr>
                  <td colspan="2">
                  <?php
                      $helper = $fb->getRedirectLoginHelper();
                      $permissions = ['user_likes']; // 要取得的權限
                      $loginUrl = $helper->getLoginUrl('http://localhost/tbs/test1020/login-callback.php', $permissions);//取得權限後要跳轉的頁面
    
                      echo '<div id="thisFBbtn"><a href="'.$loginUrl.'"><img src="img/loginFB.png"></a></div>';
                  ?>
                  </td>
                </tr>
           </table>
        </div> 
	</div>
	<script src="easydialog/easydialog.js"></script> 
	<script>
	var $ = function(){
		return document.getElementById(arguments[0]);
	};
	$('demoBtn1').onclick = function(){
		easyDialog.open({
			container : 'testBox',
			isOverlay : true,
			fixed : true
		});
	};
	$('testBox').getElementsByTagName('a')[0].onclick = function(){
		easyDialog.close();
	}
	</script>
</body>
</html>

