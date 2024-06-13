<?php include('../php-project/partiels-front/menu.php') ?>
    <!-- Navbar Section Ends Here -->



    <!-- CAtegories Section Starts Here -->
    <section class="categories" style="background-color: aliceblue;">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        // Ensure the database connection is defined and working
        if (isset($conn)) {
            $sql = "SELECT * FROM category WHERE active='Yes'  ";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = htmlspecialchars($row['title']);
                    $image_name = htmlspecialchars($row['image_name']);
        ?>
                    <a href="category-foods.php?category_id=<?php echo $id?>">
                        <div class="box-3 float-container">
                            <?php if ($image_name != "") { ?>
                                <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                            <?php } else { ?>
                                <div class="error">Image not added</div>
                            <?php } ?>
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
        <?php
                }
            } else {
                echo "<div class='error'>Category not found.</div>";
            }
        } else {
            echo "<div class='error'>Database connection not established.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>
    <!-- Categories Section Ends Here -->


    <?php include('../php-project/partiels-front/footer.php') ?>