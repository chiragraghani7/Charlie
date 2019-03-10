
<?php 
    require_once("../includes/constants.php");
    session_start();
    
        require_once("db.php");
    
        if(isset($_POST['submit_details'])){
//            echo "Hello";
            $personal_number = "7744824253";
            $active_user_id = $_SESSION["active_user_id"];
            $customer_name = $_POST['customer_name'];
            $organization_name = $_POST['organization_name'];
            $customer_phone = $_POST['customer_phone'];
            $customer_message = $_POST['customer_message'];
            echo $customer_phone;
            $query = "SELECT product_id,quantity from temp_cart WHERE active_user_id = $active_user_id";
            $result = mysqli_query($conn,$query);
            while($row = mysqli_fetch_assoc($result)){
                    $quantity = $row['quantity'];
                    $product_id = $row['product_id'];
                $query1 = "INSERT INTO orders (active_user_id, product_id, quantity, customer_name, organization_name, customer_phone, customer_message, created_at) VALUES ($active_user_id, $product_id, $quantity, '$customer_name', '$organization_name', $customer_phone, '$customer_message', now())";
                $result1 = mysqli_query($conn,$query1);
                }
        $msg = "Your Order is:";
        $msg1 = "Name of the organization is :".$organization_name."\n"."Has ordered: ";
        $query = "SELECT orders.product_id, orders.quantity, products.product_name,products.product_price from orders,products where active_user_id = $active_user_id and orders.product_id = products.product_id";
        $result = mysqli_query($conn,$query);
        while($row = mysqli_fetch_assoc($result)){
            $quantity = $row['quantity'];
            $product_id = $row['product_id'];
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $individual_amount = $quantity * $product_price;
            $msg = $msg."\n".$product_name."x".$quantity."=".$individual_amount;
            $msg1 = $msg1."\n".$product_name."x".$quantity."=".$individual_amount;
            
        }
        $msg = $msg."\n Your Total amount :".$_SESSION["total_price"];
        $msg = $msg."\n Thanks For Dealing With Charlie Grah Udyog You will recieve a confirmation call within 24 hours!!";
        $msg = $msg."\n For information about your order contact at this number:".$personal_number;
        $msg1 = $msg1."\n Total amount :".$_SESSION["total_price"];
        $msg1 = $msg1."\n Contact Number of the organization is:".$customer_phone;
        $curl = curl_init();
            //message for customer
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?country=91&sender=MSGIND&route=4&mobiles=7021197094&authkey=248044A8I7yneX5bf2786c&message=Your Order is: Biscuitsx4=9600 Your Total amount :9600 Thanks For Dealing With Charlie Grah Udyog You will recieve a confirmation call within 24 hours!! For information about your order contact at this number:7744824253",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
            if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
//        //message for me
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//          CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?country=91&sender=CHRLIE&route=4&mobiles=7021197094&authkey=242769ABa2cfCGg5bc34724&message=".$msg1,
//          CURLOPT_RETURNTRANSFER => true,
//          CURLOPT_ENCODING => "",
//          CURLOPT_MAXREDIRS => 10,
//          CURLOPT_TIMEOUT => 30,
//          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//          CURLOPT_CUSTOMREQUEST => "GET",
//          CURLOPT_SSL_VERIFYHOST => 0,
//          CURLOPT_SSL_VERIFYPEER => 0,
//        ));
//
//        $response = curl_exec($curl);
//        $err = curl_error($curl);
//
//        curl_close($curl);

        session_destroy();
//        header("Location: http://".BASE_SERVER."/essence/blog.php");
            
        }
        
        ?>