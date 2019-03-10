
               <?php
                session_start();
                require_once("charlie/db.php");
                $active_user_id = $_SESSION["active_user_id"];
               $query3 = "SELECT * FROM products,temp_cart WHERE products.product_id = temp_cart.product_id AND temp_cart.active_user_id = $active_user_id";
                
                
                $result2 = mysqli_query($conn,$query3);            
                    while($row2 = mysqli_fetch_assoc($result2)){
                    $product_id = $row2['product_id'];
                    $product_name = $row2['product_name'];
                    $product_quantity = $row2['quantity'];
                    $product_price = $row2['product_price'];
                    $cart_order_no = $row2['cart_order_no'];
                ?> <!-- Single Cart Item -->
                <?php
                        
                echo '<div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="img/bg-img/blog'.$product_id.'.jpg" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove"><button class="delete" onclick="del('.$cart_order_no.')"><i class="fa fa-close" aria-hidden="true" id=""></i></button></span>  
                             <span class="badge"><?php echo $product_name; ?></span>
                            <p class="size">Quantity : '.$product_quantity.'</p>
                            <p class="price">Price : '." ".''.$product_price.'</p> 
                        </div>
                    </a>
                </div>';
                ?>
                <?php
                    }
                ?>
                
                
                

                
               