$(document).ready(function(){
//    $count = 0;
    $(".edit").click(function(){
     $id = $(this).attr("id");
    //console.log($id);
            $("#product_id").val($id);
     $.ajax({
                url:"js/fetch1.php",
                method: "POST",
                data: {"product_id": $id},
                dataType: "json",
                success: function(data){
                    $("#product_name").val(data.product_name);
                    $("#max_quantity").val(data.max_quantity);
                    $("exampleModalCenter").modal('show');
                    
                }, 
            });
   
    });
    $("#addCart").click(function(){
        $product_id = $("#product_id").val();
        $quantity = $("#quantity").val();
        $max_quantity = $("#max_quantity").val();
        
        if($quantity < $max_quantity){
        $("#quantity").val(" ");
//        $.session.set('count','$count');
        $.ajax({
				url :"charlie/cart-ajax.php",
				method:"post",
				data:{product_id : $product_id,quantity : $quantity},
				dataType:"json",
				success:function(){
                }
    });
        }
        else{
            alert("Please enter quantity less than or equal to max quantity");
            $("#quantity").val(" ");
        }
    });
    
    $("#essenceCartBtn").click(function(){
         $.ajax({
            url:"ajaxfetch.php",
            data:{},
            dataType:"html",
            success:function(data){
                
                $("#cart-inner-list").empty();
                $("#cart-inner-list").append(data);
            }
        });
        
        $.ajax({
            url:"ajaxfetch1.php",
            data:{},
            dataType:"html",
            success:function(data){
                
                $("#cart-summary").empty();
                $("#cart-summary").append(data);
            }
        });
        
    });
});
function del(val){
//    window.alert("Hello");
    $.ajax({
            url:"ajaxdelete.php",
            method: "POST",
            data: {"cart_order_no": val},
            datatype: "json",
            success: function(data){
                renderTable();    
            }
        });
}

function renderTable(){
     $.ajax({
            url:"ajaxfetch.php",
            data:{},
            dataType:"html",
            success:function(data){
                console.log(data);
                $("#cart-inner-list").empty();
                $("#cart-inner-list").append(data);
            }
        });
        
        $.ajax({
            url:"ajaxfetch1.php",
            data:{},
            dataType:"html",
            success:function(data){
                console.log(data);
                $("#cart-summary").empty();
                $("#cart-summary").append(data);
            }
        });
        
}