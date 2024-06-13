<link rel="stylesheet" href="../css/admin.css?v= <?php echo time(); ?>">
<?php include('..//admin/partials/menu.php') ?>
<!--Main content section start-->
<div class="main_content ">
    <div class="wrapper">
        <h1> MANAGE CATEGORY</h1>

        <br>
        <?php
        if (isset($_SESSION["add-category"])) {
            echo $_SESSION["add-category"];
            unset($_SESSION["add-category"]);
        }
        if (isset($_SESSION["delete-category"])) {
            echo $_SESSION["delete-category"];
            unset($_SESSION["delete-category"]);
        }
        if (isset($_SESSION["remove"])) {
            echo $_SESSION["remove"];
            unset($_SESSION["remove"]);
        }
        if (isset($_SESSION["no-category-found"])) {
            echo $_SESSION["no-category-found"];
            unset($_SESSION["no-category-found"]);
        }
        if (isset($_SESSION['update-category'])) {
            echo $_SESSION['update-category'];
            unset($_SESSION['update-category']);
        }
        ?>
        <br><br>

        <a href="../admin/add-category.php" class="btn-add">Add Category</a>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
            </tr>
            <?php
            $sql = "SELECT * FROM category";
            $res = mysqli_query($conn, $sql);
            $sn = 1;
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];
            ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $title ?> </td>
                            <td>
                                <?php
                                if (!$image_name == "") {
                                ?>
                                    <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name ?>" width="100px">
                                <?php
                                } else {
                                    echo "<div class='error'>Image not added</div>";
                                }
                                ?>
                            </td>
                            <td><?php echo $featured ?> </td>
                            <td><?php echo $active ?> </td>
                            <td>
                                <a href="<?php echo SITEURL . 'admin/update-category.php?id=' . $id ?>" class="btn-update">Update</a>

                                <a href="<?php echo SITEURL . 'admin/delete-category.php?id=' . $id . '&image_name=' . $image_name; ?>" class="btn-delete">Delete</a>

                            </td>
                        </tr>
            <?php

                    }
                }
            }

            ?>

        </table>
    </div>

</div>


<?php include('../admin/partials/footer.php') ?>