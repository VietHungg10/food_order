<?php include('../php-project/partiels-front/menu.php') ?>
    <!-- Navbar Section Ends Here -->
<?php
    if(isset($_GET['category_id'])){
        //category id is isset and get id
        $category_id =$_GET['category_id'];
        //sql querry
        $sql ="SELECT title FROM category WHERE id='$category_id'";
        //execute queryy
        $res = mysqli_query($conn, $sql);
        //get value from database
        $row = mysqli_fetch_assoc($res);
        //get title
        $category_title =$row['title'];
    }
    else{
        header("location:".SITEURL);
    }


?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // Ensure the database connection is defined and working
        $sql2 ="SELECT * FROM food WHERE category_id='$category_id'";
        $res2 = mysqli_query($conn, $sql2);
        $count2=mysqli_num_rows($res2);
        if($count2>0){
            while($row2=mysqli_fetch_assoc($res2)){
                $id = $row2['id'];
                $title=$row2['title'];
                $price=$row2['price'];
                $description=$row2['description'];
                $image_name=$row2['image_name'];
?>

<div class="food-menu-box" >
                        <div class="food-menu-img">
                            <?php if ($image_name != "") { ?>
                                <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                            <?php } else { ?>
                                <div class="error">Image not added</div>
                            <?php } ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
              <?php  
            }
        }
        else {
           echo "<div class='error'>Food not found.</div>";
       }
    
   ?>
        

                   
       
        
        <!-- Center the "See All Foods" link -->
      
    </div>
</section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('../php-project/partiels-front/footer.php') ?>