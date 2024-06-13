<?php include('../php-project/partiels-front/menu.php') ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php  $search = $_POST['search'];?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    
    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
       

        $sql ="SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

        $res=mysqli_query($conn,$sql);

        $count =mysqli_num_rows($res);

        if($count>0){
            while($row=mysqli_fetch_assoc($res)){
                $id=$row['id'];
                $title=$row['title'];
                $description=$row['description'];
                $price =$row['price'];
                $image_name=$row['image_name'];
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
                            <a href="order.php" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                <?php

            }

        }


?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

         

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('../php-project/partiels-front/footer.php') ?>