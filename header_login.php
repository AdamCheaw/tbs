<?php
require ("connMysql.php");
if(isset ($_SESSION["demandDown"])){
	unset($_SESSION["demandDown"]);
	echo "<script>alert('商品已下架');</script>";
}
if(isset ($_SESSION["supplyDown"])){
	unset($_SESSION["supplyDown"]);
	echo "<script>alert('商品已下架');</script>";
}

$sql_query = "select * from user_list where uid='".$_SESSION['user_id']."';";
$result = mysqli_query($db_conn,$sql_query);
$row = mysqli_fetch_array($result)
?>
<!DOCTYPE html>
<head>
    <link href="css/header.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/reveal.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
    <script type="text/javascript" src="js/jquery.reveal.js"></script>
</head>

<body>
<div id="header-inner">
    <div id="logo">
        <a href="demand.php"><img src="img/logo.png" /></a>
    </div>
    <ul id="header-nav">
        <li><a href="#">幫助</a></li>
        <li><a href="logout.php">登出</a></li>
        <li><a href="user-edit.php#home"><?php echo $row["nickname"] ?></a></li>
        <img class="user-pic" src="
        <?php 
            if($row["picture"] == null)
            {
                echo "img/selfie.png";
            }
            else
            {
                echo $row['picture'] ;
            }
		?>		
        ">
        <?php
			/*$_SESSION['check'] = 0;
			$sql_Pcheck = "select * from user_trade where provider_id = '".$_SESSION['user_id']."' and product_id != 'null' ";
			$rs_Pc = mysqli_query($db_conn,$sql_Pcheck);
			while($row_Pc = mysqli_fetch_array($rs_Pc)){
				if($row_Pc['provider_check'] == 'no'){
					$_SESSION['check']++;
				}
			}
						
			$sql_Pcheck2 = "select * from user_trade where requester_id = '".$_SESSION['user_id']."' and demandList_id != 'null' ";
			$rs_Pc2 = mysqli_query($db_conn,$sql_Pcheck2);
			while($row_Pc2 = mysqli_fetch_array($rs_Pc2)){
				if($row_Pc2['provider_check'] == 'no'){
					$_SESSION['check']++;
				}
			}

			$sql_Rcheck = "select * from user_trade where requester_id = '".$_SESSION['user_id']."' and product_id != 'null' ";
			$rs_Rc = mysqli_query($db_conn,$sql_Rcheck);
			while($row_Rc = mysqli_fetch_array($rs_Rc)){
				if($row_Rc['requester_check'] == 'no'){
					$_SESSION['check']++;
				}
			}
			if($_SESSION['check'] != 0){
				echo "<li class='check'>CHECK</li>";
				//unset($_SESSION['Rcheck']);
			}*/
        ?>
    </ul>
</div>
<?php
	if(isset ($_SESSION['login'])){
		unset($_SESSION['login']);
?>
	<script type="text/javascript">
        function Toast(){
            $.toast({
                text: "登入成功", // Text that is to be shown in the toast
                heading: 'Login', // Optional heading to be shown on the toast
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
    if(isset ($_SESSION['tradeConfirm'])){
    unset($_SESSION['tradeConfirm']);
?>
    <script type="text/javascript">
        function Toast(){
            $.toast({
                text: "交易已經確認", // Text that is to be shown in the toast
                heading: 'Trade', // Optional heading to be shown on the toast
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
    if(isset ($_SESSION['tradeConfirm'])){
    unset($_SESSION['tradeConfirm']);
?>
    <script type="text/javascript">
        function Toast(){
            $.toast({
                text: "交易已經確認", // Text that is to be shown in the toast
                heading: 'Trade', // Optional heading to be shown on the toast
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
    if(isset ($_SESSION['Scoring'])){
    unset($_SESSION['Scoring']);
?>
    <script type="text/javascript">
        function Toast(){
            $.toast({
                text: "評價成功", // Text that is to be shown in the toast
                heading: 'Comment', // Optional heading to be shown on the toast
                icon: 'success', // Type of toast icon
                showHideTransition: 'slide', // fade, slide or plain
                allowToastClose: true, // Boolean value true or false
                hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                textAlign: 'left',  // Text alignment i.e. left, right or center
                loader: true,  // Whether to show loader or not. True by default
                loaderBg: '#9ec600',  // Background color of the toast loader
            });
        }window.onload= Toast;
    </script>
<?php } ?>
<?php
    if(isset ($_SESSION['acvited'])){
    unset($_SESSION['acvited']);
?>
    <script type="text/javascript">
        function Toast(){
            $.toast({
                text: "您的帳號激活成功", // Text that is to be shown in the toast
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
	if(isset ($_SESSION['insertDB'])){
	unset($_SESSION['insertDB']);	
?>
	<script type="text/javascript">
        function Toast(){
            $.toast({
                text: "確認上架", // Text that is to be shown in the toast
                heading: 'Supply', // Optional heading to be shown on the toast
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
<?php }?>
<?php
	if(isset ($_SESSION['noInsertDB'])){
	unset($_SESSION['noInsertDB']);	
?>
	<script type="text/javascript">
        function Toast(){
            $.toast({
                text: "上架失敗，請重新輸入", // Text that is to be shown in the toast
                heading: 'Supply', // Optional heading to be shown on the toast
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
<?php
	if(isset ($_SESSION["Like"])){
		unset($_SESSION["Like"]);
?>
	<script type="text/javascript">
        function Toast(){
            $.toast({
                text: "成功Like", // Text that is to be shown in the toast
                heading: 'Like', // Optional heading to be shown on the toast
                icon: 'success', // Type of toast icon
                showHideTransition: 'slide', // fade, slide or plain
                allowToastClose: true, // Boolean value true or false
                hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                textAlign: 'left',  // Text alignment i.e. left, right or center
                loader: true,  // Whether to show loader or not. True by default
                loaderBg: '#9ec600',  // Background color of the toast loader
            });
        }window.onload= Toast;
    </script>
<?php } ?>
<?php
	if(isset ($_SESSION["Bookmark"])){
		unset($_SESSION["Bookmark"]);
?>
	<script type="text/javascript">
        function Toast(){
            $.toast({
                text: "成功Bookmark", // Text that is to be shown in the toast
                heading: 'Bookmark', // Optional heading to be shown on the toast
                icon: 'success', // Type of toast icon
                showHideTransition: 'slide', // fade, slide or plain
                allowToastClose: true, // Boolean value true or false
                hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                textAlign: 'left',  // Text alignment i.e. left, right or center
                loader: true,  // Whether to show loader or not. True by default
                loaderBg: '#9ec600',  // Background color of the toast loader
            });
        }window.onload= Toast;
    </script>
<?php } ?>
<?php
	if(isset ($_SESSION["adyLike"])){
		unset($_SESSION["adyLike"]);
?>
	<script type="text/javascript">
        function Toast(){
            $.toast({
                text: "您已Like過了", // Text that is to be shown in the toast
                heading: 'Like', // Optional heading to be shown on the toast
                icon: 'warning', // Type of toast icon
                showHideTransition: 'slide', // fade, slide or plain
                allowToastClose: true, // Boolean value true or false
                hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                textAlign: 'left',  // Text alignment i.e. left, right or center
                loader: true,  // Whether to show loader or not. True by default
                loaderBg: '#9ec600',  // Background color of the toast loader
            });
        }window.onload= Toast;
    </script>
<?php } ?>
<?php
	if(isset ($_SESSION["adyBookmark"])){
		unset($_SESSION["adyBookmark"]);
?>
	<script type="text/javascript">
        function Toast(){
            $.toast({
                text: "您已Bookmark過了", // Text that is to be shown in the toast
                heading: 'Bookmark', // Optional heading to be shown on the toast
                icon: 'warning', // Type of toast icon
                showHideTransition: 'slide', // fade, slide or plain
                allowToastClose: true, // Boolean value true or false
                hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                textAlign: 'left',  // Text alignment i.e. left, right or center
                loader: true,  // Whether to show loader or not. True by default
                loaderBg: '#9ec600',  // Background color of the toast loader
            });
        }window.onload= Toast;
    </script>
<?php } ?>
</body>
</html>


