<?php
session_start();
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
        	<div id="email-form">
            	<form action="forget_pass_sendmail.php" method="post" enctype="multipart/form-data">
                	<h2>输入您註冊的E-mail ，找回密碼：</h2>
                    <table>
                	<tr>
                    	<td><input type="email" class="inputText" name="email" required></td> 
                	</tr>
                    <tr>
                    	<td><input type="submit" class="fpbutton" value="提 交"></td>
                	</tr>
                    </table>
                </form>
            </div>
        </div>
	</div>
    <script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.toast.js"></script>
    <?php
		if(isset ($_SESSION['unRegisterEmail'])){
			unset($_SESSION['unRegisterEmail']);
	?>
		<script type="text/javascript">
			function Toast(){
				$.toast({
					text: "該E-mail尚未註冊", // Text that is to be shown in the toast
					heading: 'Register', // Optional heading to be shown on the toast
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