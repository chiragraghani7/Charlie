<?php

    $conn =mysqli_connect("localhost", "chirag Raghani", "7744824253", "charlie");

    if(isset($_POST['product_id'])){
        $product_id = $_POST["product_id"];
//        $category_id = $_POST['category_id'];
        $query = "select product_id, product_name, max_quantity from products WHERE product_id = $product_id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    }

?>