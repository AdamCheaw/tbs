<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>TbS</title>
    <link rel="shortcut icon" href="img/favicon.ico" />
     <link href="css/fb_register.css" rel="stylesheet" type="text/css"/>
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
        	<div id="FBregForm">
            	<fieldset>
                	<h3>為了更好的使用我們的服務，完成以下設置即可創建一個帳號。</h3><hr/>
            		<form action="fb_register_insertdb.php" method="post" enctype="multipart/form-data">
                    <div id="thisTable"><table border="0">
                        <tr>
                        	<td id="thisPic" rowspan="6"><?php echo "<img src='http://graph.facebook.com/".$_SESSION['FBuid']."/picture?type=large'>"?></td> 
                            <td>真實姓名：</td>
                            <td><input type="text" name="username" class="inputText" required></td>
                        </tr>
                        <tr>
                            <td>手機：</td>
                            <td><input type="text" name="phone" class="inputText" required></td>
                        </tr>
                        <tr>
                            <td>E-mail: </td>
                            <td><input type="text" name="email" class="inputText" required></td>
                        </tr>
                        <tr>
                            <td>生日：</td>
                            <td><input type="date" name="birthday" class="inputDate" required></td>
                        </tr>
                        <tr>
                        	<td id="thisA" colspan="2">
                            	<input type="checkbox" required>
                                同意創建您的TBS賬戶<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;同意我們的<a href="register_protocol.php" target="_blank">注冊協議</a>
                            </td>
                        </tr>
                        <tr>
                        	<td colspan="2"><input type="submit" class="button" value="創建賬戶"></td>
                        </tr>
                    </table></div>
            		</form>
            	</fieldset>
            </div>
        </div>
    </div>
</body>
</html>