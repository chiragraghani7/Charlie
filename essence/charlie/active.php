<?php
	require_once("db.php");
	session_start();
	if(isset($_SESSION["active_user_id"])){
		echo "true";
	}else{
    $query = "INSERT INTO active_users(entered_at) VALUES(now())";
    mysqli_query($conn,$query);
    $num = mysqli_insert_id($conn);
//    echo $num;    
	$_SESSION["active_user_id"] = $num;
}
?>