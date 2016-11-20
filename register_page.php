<?php
session_start();
unset($_SESSION['fb_access_token']);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>TbS</title>
    <link rel="shortcut icon" href="img/favicon.ico" />
     <link href="css/register_page.css" rel="stylesheet" type="text/css"/>
     <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
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
        	<div id="regForm">
            	<fieldset>
                <h1>賬戶註冊</h1><hr/>
            	<form action="register_insertdb.php" method="post" enctype="multipart/form-data">
                <table id="regFormTable">
                    <tr>
                    	<td>真實姓名：</td>
                    	<td><input type="text" name="username" class="inputText" required>
                        	<?php	
								if(isset ($_SESSION['registerEmail'])){
									unset($_SESSION['registerEmail']);
									echo "<span id='error'>*賬號重複，請重新輸入</span>";
								} 
							?>
                        </td>
                    </tr>
               		<tr>
                    	<td>暱稱：</td>
                		<td><input type="text" name="nickname" class="inputText" required></td>
                    </tr>
                	<tr>
                    	<td>手機：</td>
                		<td><input type="text" name="phone" class="inputText" required></td>
                    </tr>
	                <tr>
                    	<td>E-mail：</td>
                		<td><input type="text" name="email" class="inputText" placeholder="使用NCNU EMAIL" required></td>
                    </tr>
                	<tr>
                    	<td>密碼：</td>
                		<td><input type="password" name="password" class="inputText" required>
                        	<?php 
								if(isset ($_SESSION['registerPwd'])){
									unset($_SESSION['registerPwd']);
									echo "<span id='error'>*密碼不相同，請重新輸入</span>";	
								}
							?>
                        </td>
                    </tr>
                	<tr>
                    	<td>重輸密碼：</td>
                		<td><input type="password" name="password2" class="inputText" required></td>
                    </tr>
               		<tr>
                    	<td>生日：</td>
                		<td><input type="date" name="birthday" class="inputDate" required></td>
                    </tr>
                	<tr>
                    	<td>性別：</td>
                		<td><label for="radio1"><input id="radio1" type="radio" name="gender" value="male" class="radio" required>男</label>
                			<label for="radio2"><input id="radio2" type="radio" name="gender" value="female" class="radio" required>女</label></td>
                    </tr>
                        <td id="thisA" colspan="2">
                            <input type="checkbox" required>
                            同意創建您的TBS賬戶， 同意我的<a href="register_protocol.php" target="_blank">注冊協議</a>
                        </td>
                    </tr>
                    <tr>
                		<td colspan="2"><input type="submit" class="button" value="註冊"></td>
                    </tr>
                </table>
                </form>
                </fieldset>
            </div>
        </div>
    </div>
    <script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.toast.js"></script>
</body>
</html>