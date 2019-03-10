<!DOCTYPE html>
<html>
<head>
	<title>THIS IS PRODUCT</title>
</head>
<body onload="loadfunction()">
	<label>PRODUCT NAME <input type="text" name="product_name" value="product 1"></label>
	<label>PRODUCT DESCRIPTION  <input type="text" name="product_desc" value="product description"></label>
	<label>Product Quantity <input type="text" name="product_quan"></label>
	<input type="text" name="product_id_1" value="1">
	<button id="btn_submit" onclick="myfunction(1)">SUBMIT</button>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<script type="text/javascript">
		function myfunction(id){
			$.ajax({
				url :"cart-ajax.php",
				method:"post",
				data:{id : id},
				dataType:"json",
				success:function(data){
				}
			});
		}
		function loadfunction(){
			$.ajax({
				url:"active.php",
				method:"post",
				dataType:"text",
				success:function(data){
					console.log(data);
				}
			});
		}
	</script>
</body>
</html>