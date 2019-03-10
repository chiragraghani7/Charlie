<html>
<head>
    <div id="fk" style="background:blue">
        
    </div>
    <button id="btn">Submit</button>
</head>
<body>
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script>
        $("#btn").click(function(){
             $.ajax({
            url:"trailphp.php",
            data:{},
            dataType:"html",
            success:function(data){
                $("#fk").append(data);
            }
        });
        });
       
    </script>
</body>
</html>