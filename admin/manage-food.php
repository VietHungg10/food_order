<link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
<?php include('../admin/partials/menu.php') ?>

<!--Main content section start-->
<div class="main_content">
    <div class="wrapper">
        <h1>MANAGE FOOD</h1>
        <br>

        <?php
       
        if (isset($_SESSION["add-food"])) {
            echo $_SESSION["add-food"];
            unset($_SESSION["add-food"]);
        }
        if (isset($_SESSION["delete-food"])) {
            echo $_SESSION["delete-food"];
            unset($_SESSION["delete-food"]);
        }
        if (isset($_SESSION["update-food"])) {
            echo $_SESSION["update-food"];
            unset($_SESSION["update-food"]);
        }
        ?>
        <br>
        <br>
        <a href="../admin/add-food.php" class="btn-add">Add Food</a>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
            </tr>
            <?php
            $sql = "SELECT * FROM food";
            $res = mysqli_query($conn, $sql);
            $sn = 1;
            $count = mysqli_num_rows($res);
            if ($res == TRUE) {
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $price = $rows['price'];  // Corrected variable name here
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $price; ?></td> 
                            <td>
                                <?php
                                if ($image_name != "") {
                                ?>
                                    <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" width="100px">
                                <?php
                                } else {
                                    echo "<div class='error'>Image not added</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL . 'admin/update-food.php?id=' . $id; ?>" class="btn-update">Update</a>
                                <a href="<?php echo SITEURL . 'admin/delete-food.php?id=' . $id . '&image_name=' . $image_name; ?>" class="btn-delete">Delete</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='error'>Food not Added Yet.</td></tr>";
                }
            }
            ?>
        </table>
    </div>
</div>
<!--Footer section start-->
<?php include('../admin/partials/footer.php') ?>
<!--Footer section end-->
