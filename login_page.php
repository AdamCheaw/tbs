<?php
require("connMysql.php");
require ("connFB.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>TbS</title>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <link href="css/login_page.css" rel="stylesheet" type="text/css"/>
    <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
</head>
<body>
	<div id="f_wrapper">
        <div id="f_header">
            <div id="f_header-inner">
                <div id="f_logo">
                    <a href="demand.php"><img src="img/logo.png" /></a>
                </div>
            </div>
        </div>
		<div id="f_content">
            <div id="bck-img"><img src="img/bike.jpg"></div>
            <div id="login-form">
                <table>
                <form action="login.php" method="post" enctype="multipart/form-data">
                      <tr>
                        <td class="thisTitle" colspan="2"><h1>帳戶登入</h1><hr/></td>
                      </tr>
                      <tr>
                      	<?php
							if(isset ($_SESSION['unLogin'])){
								unset($_SESSION['unLogin']);
								echo "<td colspan='2'>";
								echo "<div id='error'>登入失敗，請確認帳密</div>";
								echo "</td>";
							}else if(isset ($_SESSION['unActive'])){
								unset($_SESSION['unActive']);
								echo "<td colspan='2'>";
								echo "<div id='error'>帳號還未激活，請前往您的郵箱激活</div>";
								echo "</td>";	
							}else if(isset ($_SESSION['logout'])){
								unset($_SESSION['logout']);
								echo "<td colspan='2'>";
								echo "<div id='error'>已登出</div>";	
								echo "</td>";
							}
						?>
                      </tr>
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
                        <td colspan="2"><div id="thisOr">———————— OR ————————</div></td>
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
        <div id="thisFooter">
            <?php require ("footer.php")?>
        </div>
	</div>
    <script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.toast.js"></script>
</body>
</html>