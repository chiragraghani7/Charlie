 <?php
            session_start();
            
                require_once("charlie/db.php");
                $active_user_id = $_SESSION["active_user_id"];
                
                $query = "SELECT quantity, product_price FROM products,temp_cart WHERE products.product_id = temp_cart.product_id AND temp_cart.active_user_id = $active_user_id";
                $result = mysqli_query($conn,$query);
                $sum = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $x = $row['quantity'];
                    $y = $row['product_price'];
                    $sum += $x*$y;
                    $_SESSION["total_price"] = $sum;
                }
            
            
            ?>
            
            <?php
            echo'
                <h2>Summary</h2>
                <ul class="summary-table">
                    
                    <li><span>total:</span> <span>'.$sum.'</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="details.php" class="btn essence-btn">check out</a>
                </div>';
            
             ?>
