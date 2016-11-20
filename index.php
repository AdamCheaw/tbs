<?php
//判斷使用的瀏覽器，如果是IE則跳alert
$agent = $_SERVER['HTTP_USER_AGENT'];
if(strpos($agent,"MSIE 12.0")){
	echo "<script>alert('建議使用Google Chrome或Mozila Firefox瀏覽器')</script>";
}else if(strpos($agent,"MSIE 11.0")){
	echo "<script>alert('建議使用Google Chrome或Mozila Firefox瀏覽器')</script>";
}else if(strpos($agent,"MSIE 10.0")){
	echo "<script>alert('建議使用Google Chrome或Mozila Firefox瀏覽器')</script>";
}else if(strpos($agent,"MSIE 9.0")){
	echo "<script>alert('建議使用Google Chrome或Mozila Firefox瀏覽器')</script>";
}else if(strpos($agent,"MSIE 8.0")){
	echo "<script>alert('建議使用Google Chrome或Mozila Firefox瀏覽器')</script>";
}else if(strpos($agent,"MSIE 7.0")){
	echo "<script>alert('建議使用Google Chrome或Mozila Firefox瀏覽器')</script>";
}else if(strpos($agent,"MSIE 6.0")){
	echo "<script>alert('建議使用Google Chrome或Mozila Firefox瀏覽器')</script>";
}

//自動讀取首頁
require( dirname( __FILE__ ) . '/demand.php' );





