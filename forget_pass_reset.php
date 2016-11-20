<?php
include ("connMysql.php");//连接数据库 
session_start();

$email = stripslashes(trim($_GET['email']));
$token = stripslashes(trim($_GET['token']));
$sql_query = "select * from user_list where email='".$email."' ";
$result = mysqli_query($db_conn,$sql_query);
while($row = mysqli_fetch_array($result)){
	$mtToken = md5($row['uid'].$row['username'].$row['password']);
	
	if($token == $mtToken){
		$_SESSION['rEmail'] = $email;
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
					<div id="reset-form">
						<form action="forget_pass_insertdb.php" method="post" enctype="multipart/form-data">
                        	<h2>重置您的密碼：</h2>
                           	<table>
                            <tr>
                           		<td>新密碼： </td>
                            	<td><input type="password" class="inputText" name="pass1"></td>
                            </tr>
                            <tr>
                            	<td>重輸新密碼： </td>
                            	<td><input type="password" class="inputText" name="pass2"></td> 
                            </tr>
                            <tr>
                            	<td colspan="2"><input type="submit" class="button" value="提 交"></td>
                        	</tr>
                            </table>
                        </form>
					</div>
				</div>
			</div>
            <script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
			<script type="text/javascript" src="js/jquery.toast.js"></script>
            <?php
                if(isset($_SESSION['resetPwd'])){
					unset($_SESSION['resetPwd']);
            ?>
                <script type="text/javascript">
                    function Toast(){
                        $.toast({
                            text: "密碼不相同，請重新輸入", // Text that is to be shown in the toast
                            heading: 'Password', // Optional heading to be shown on the toast
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
            <?php } ?>
		</body>
		</html>
        <?php
	}else{
		$_SESSION['cantResetPass'] =1;
		header ("Location: demand.php");
	}
} 
?>