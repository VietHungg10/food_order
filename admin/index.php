
<html>

<head>
    <title>Food Order Website-Homepage</title>
    <link rel="stylesheet" href="../css/admin.css?v= <?php echo time(); ?>">
</head>

<body>
   
   <?php 
   if(isset( $_SESSION['login'])){
		echo $_SESSION['login'];
		unset( $_SESSION['login']);
	} ?>
    <?php include('../admin/partials/menu.php')?>
    <!--Main content section start-->
    <div class="main_content ">
        <div class="wrapper">
           <h1> <strong>DASHBOARD</strong></h1>
<br><br>
            <div class="col-4 text-center">
            <?php  
             $sql="SELECT * FROM category";
            $res=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($res)
            ?>
                <h1><?php echo $count ?></h1>
                Categories
            </div>
            <div class="col-4 text-center">
            <?php  
             $sql2="SELECT * FROM food";
            $res2=mysqli_query($conn,$sql2);
            $count2=mysqli_num_rows($res2)
            ?>
                <h1><?php echo $count2 ?></h1>
                Food
            </div>
            <div class="col-4 text-center">
            <?php  
             $sql3="SELECT * FROM `order`";
            $res3=mysqli_query($conn,$sql3);
            $count3=mysqli_num_rows($res3)
            ?>
                <h1><?php echo $count3 ?></h1>
               Total orders
            </div>
            <div class="col-4 text-center">
                <?php
                $sql4="SELECT SUM(total) AS Total FROM `order`";
                $res4=mysqli_query($conn,$sql4);
                 $count3=mysqli_num_rows($res4);
                 $row=mysqli_fetch_assoc($res4);
                 $total_revenue=$row['Total']
                
                ?>
                <h1><?php echo $total_revenue?></h1>
               Revenue Generated
            </div>
            <div class=clearfix></div>
        </div>

    </div>
    <!--Main content section end-->

<?php include('../admin/partials/footer.php') ?>
    <!--Footer section start-->


    <!--Footer section end-->
</body>

</html>