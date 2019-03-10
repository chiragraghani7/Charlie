<?php

    require_once("charlie/db.php");

    
        $cart_order_no = $_POST["cart_order_no"];

        $query = "DELETE FROM temp_cart WHERE cart_order_no = $cart_order_no";
        $result = mysqli_query($conn, $query);
        
    

?>