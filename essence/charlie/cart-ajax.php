<?php
require_once("db.php");
session_start();
if(isset($_SESSION["active_user_id"])){
	$active_user_id = $_SESSION["active_user_id"];
	$product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];
	$query = "INSERT INTO temp_cart(active_user_id,product_id,quantity) VALUES($active_user_id,$product_id,$quantity)";
	mysqli_query($conn,$query);
}
?>