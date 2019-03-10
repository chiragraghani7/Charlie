<!DOCTYPE html>
   <?php
    session_start();
    ?>
   <html>
   
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/details.css">
    </head>
    <body>
       
        <div class="container">
           <h1>Details</h1>
       <hr style="background: #37abed">
            <form action="charlie/add-details.php" method="post">
                <label>Name</label>
                <input type="text" class="form-control" name="customer_name">
                <label>Name of Organization</label>
                <input type="text" class="form-control" name="organization_name">
                <label>Phone Number</label>
                <input type="text" class="form-control" name="customer_phone">
                <label for="">Message</label>
                <textarea id="" cols="20" rows="10" class="form-control" name="customer_message"></textarea><br>
                
                <label for="">Total Amount: <?php echo $_SESSION["total_price"]; ?></label><br>
                <button class="btn btn-primary" name="submit_details">Submit</button>
            </form>
        </div>
        
    </body>
</html>