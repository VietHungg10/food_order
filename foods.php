<?php include('../php-project/partiels-front/menu.php') ?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // Ensure the database connection is defined and working
        if (isset($conn)) {
            $sql2 = "SELECT * FROM food WHERE active='Yes'";
            $res2 = mysqli_query($conn, $sql2);
            $count = mysqli_num_rows($res2);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = htmlspecialchars($row['title']);
                    $price = htmlspecialchars($row['price']);
                    $image_name = htmlspecialchars($row['image_name']);
                    $description = htmlspecialchars($row['description']);
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
            } else {
                echo "<div class='error'>Food not found.</div>";
            }
        } else {
            echo "<div class='error'>Database connection not established.</div>";
        }
        ?>
        
        <!-- Center the "See All Foods" link -->
        
    </div>
</section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <?php include('../php-project/partiels-front/footer.php') ?>