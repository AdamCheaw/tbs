<?php
session_start();
require ("connMysql.php");
$id=(int)$_GET['id'];
$type = $_GET['type'];
if($id<=0){
	echo "empty ID";
	exit(0);
}
if(isset($_SESSION['user_id'])){
	$uid = $_SESSION['user_id'];
	$sql_uil = "select * from user_item_like where uid='".$uid."' ";
	$rs_uil = mysqli_query($db_conn,$sql_uil);
	$row_uil = mysqli_fetch_array($rs_uil);
		if($row_uil['uid'] == $uid){
			$sql = "select * from supply_list where s_type='".$type."' and s_id='".$id."';";
			$result = mysqli_query($db_conn,$sql);
			$row = mysqli_fetch_array($result);
			
			$sil = explode(" ", $row_uil["supply_item_like"]);
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
				
				$sql_uil2 = "select * from user_item_like where uid='".$uid."';";
				$rs_uil2 = mysqli_query($db_conn,$sql_uil2);
				$row_uil2 = mysqli_fetch_array($rs_uil2);
				$new_sil = $row_uil2["supply_item_like"]." ".$row_like["sl_id"];
				
				$sql_uil3 = "update user_item_like set supply_item_like='".$new_sil."' where uid='".$uid."';";
				mysqli_query($db_conn,$sql_uil3) or die("MySQL like update DATA error");
				
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
			$sql_uil4 = "insert into user_item_like(uid, supply_item_like) values ('$uid', '$sil_id')";
			mysqli_query($db_conn,$sql_uil4) or die("MySQL insert DATA error");
			
			echo "<script>history.go(-1);</script>";
		}
}else{
	$_SESSION['unLoginForLike'] =1;
	echo "<script>history.go(-1);</script>"; 
}

?>
