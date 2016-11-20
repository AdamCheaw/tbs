<?php
session_start();
require ("connMysql.php");
$id=(int)$_GET['id'];
$type = $_GET['type'];
$bl = $_GET['bl'];
if($id<=0){
	echo "empty ID";
	exit(0);
}
if(isset($_SESSION['user_id'])){
	$uid = $_SESSION['user_id'];
	$sql_uil = "select * from user_bookmark_like where uid='".$uid."' ";
	$rs_uil = mysqli_query($db_conn,$sql_uil);
	$row_uil = mysqli_fetch_array($rs_uil);
	if($bl == 'bookmark'){
		if($row_uil['uid'] == $uid){
			$sql = "select * from supply_list where s_type='".$type."' and s_id='".$id."';";
			$result = mysqli_query($db_conn,$sql);
			$row = mysqli_fetch_array($result);
			
			$sil = explode(" ", $row_uil["item_bookmark"]);
			$sil_length=count($sil);
			for($i=0; $i<$sil_length; $i++){
				if($sil[$i] == $row["sl_id"]){
					$_SESSION['adyBookmark'] =1;
				}
			}
			if(isset($_SESSION['adyBookmark'])){
				echo "<script>history.go(-1);</script>";
			}else{
				$sql_bookmark = "select * from supply_list where s_type='".$type."' and s_id='".$id."';";
				$rs_bookmark = mysqli_query($db_conn,$sql_bookmark);
				$row_bookmark = mysqli_fetch_array($rs_bookmark);
				$new_bookmark = $row_bookmark['bookmark_quantity'] + 1;
				
				$sql_bookmark2 = "update supply_list set bookmark_quantity='".$new_bookmark."' where s_type='".$type."' and s_id='".$id."';";
				mysqli_query($db_conn,$sql_bookmark2) or die("MySQL bookmark update DATA error");
				
				$sql_uib2 = "select * from user_bookmark_like where uid='".$uid."';";
				$rs_uib2 = mysqli_query($db_conn,$sql_uib2);
				$row_uib2 = mysqli_fetch_array($rs_uib2);
				$new_sib = $row_uib2["item_bookmark"]." ".$row_bookmark["sl_id"];
				
				$sql_uib3 = "update user_bookmark_like set item_bookmark='".$new_sib."' where uid='".$uid."';";
				mysqli_query($db_conn,$sql_uib3) or die("MySQL bookmark update DATA error");
				
				$_SESSION['Bookmark'] =1;
				echo "<script>history.go(-1);</script>";
			}
		}else{
			$sql_bookmark = "select * from supply_list where s_type='".$type."' and s_id='".$id."';";
			$rs_bookmark = mysqli_query($db_conn,$sql_bookmark);
			$row_bookmark = mysqli_fetch_array($rs_bookmark);
			$new_bookmark = $row_bookmark['bookmark_quantity'] + 1;
			
			$sql_bookmark2 = "update supply_list set bookmark_quantity='".$new_like."' where s_type='".$type."' and s_id='".$id."';";
			mysqli_query($db_conn,$sql_bookmark2) or die("MySQL bookmark update DATA error");
			
			$sib_id = $row_bookmark["sl_id"];
			$sql_uib4 = "insert into user_bookmark_like(uid, item_bookmark) values ('$uid', '$sib_id')";
			mysqli_query($db_conn,$sql_uib4) or die("MySQL bookmark insert DATA error");
			
			$_SESSION['Bookmark'] =1;
			echo "<script>history.go(-1);</script>";
		}
	}else if($bl == 'like'){
		if($row_uil['uid'] == $uid){
			$sql = "select * from supply_list where s_type='".$type."' and s_id='".$id."';";
			$result = mysqli_query($db_conn,$sql);
			$row = mysqli_fetch_array($result);
			
			$sil = explode(" ", $row_uil["item_like"]);
			$sil_length=count($sil);
			for($i=0; $i<$sil_length; $i++){
				if($sil[$i] == $row["sl_id"]){
					$_SESSION['adyLike'] =1;
				}
			}
			if(isset($_SESSION['adyLike'])){
				echo "<script>history.go(-1);</script>";
			}else{
				$sql_like = "select * from supply_list where s_type='".$type."' and s_id='".$id."';";
				$rs_like = mysqli_query($db_conn,$sql_like);
				$row_like = mysqli_fetch_array($rs_like);
				$new_like = $row_like['like_quantity'] + 1;
				
				$sql_like2 = "update supply_list set like_quantity='".$new_like."' where s_type='".$type."' and s_id='".$id."';";
				mysqli_query($db_conn,$sql_like2) or die("MySQL like update DATA error");
				
				$sql_uil2 = "select * from user_bookmark_like where uid='".$uid."';";
				$rs_uil2 = mysqli_query($db_conn,$sql_uil2);
				$row_uil2 = mysqli_fetch_array($rs_uil2);
				$new_sil = $row_uil2["item_like"]." ".$row_like["sl_id"];
				
				$sql_uil3 = "update user_bookmark_like set item_like='".$new_sil."' where uid='".$uid."';";
				mysqli_query($db_conn,$sql_uil3) or die("MySQL like update DATA error");
				
				$_SESSION['Like'] =1;
				echo "<script>history.go(-1);</script>";
			}
		}else{
			$sql_like = "select * from supply_list where s_type='".$type."' and s_id='".$id."';";
			$rs_like = mysqli_query($db_conn,$sql_like);
			$row_like = mysqli_fetch_array($rs_like);
			$new_like = $row_like['like_quantity'] + 1;
			
			$sql_like2 = "update supply_list set like_quantity='".$new_like."' where s_type='".$type."' and s_id='".$id."';";
			mysqli_query($db_conn,$sql_like2) or die("MySQL like update DATA error");
			
			$sil_id = $row_like["sl_id"];
			$sql_uil4 = "insert into user_bookmark_like(uid, item_like) values ('$uid', '$sil_id')";
			mysqli_query($db_conn,$sql_uil4) or die("MySQL like insert DATA error");
			
			$_SESSION['Like'] =1;
			echo "<script>history.go(-1);</script>";
		}
	}
}else{
	$_SESSION['unLoginForBL'] =1;
	echo "<script>history.go(-1);</script>"; 
}

?>
