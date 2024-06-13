<link rel="stylesheet" href="../css/admin.css?v= <?php echo time(); ?>">
<?php include "../admin/partials/menu.php"; ?>
<div class="main_content">
    <div class="wrapper">
        <h1> UPDATE FOOD</h1>

        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM food WHERE id ='$id'";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_image = $row['image_name'];
                    $category = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
            } else {
                // Redirect to manage admin page with a session message
                $_SESSION['no-food-found'] = "<div class='error'>Food not found.</div>";
                header("Location:" . SITEURL . "admin/manage-category.php");
            }
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><input type="text" name="description" value="<?php echo $description; ?>"></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Current image</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>/images/food/<?php echo $current_image; ?>" width="100px">
                        <?php
                        } else {
                            echo "<div class='error'>Image not added</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New image:</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_id = $row['id'];
                                    $category_title = $row['title'];
                            ?>
                                    <option value="<?php echo $category_id; ?>" <?php if ($category_id == $category) echo "selected"; ?>>
                                        <?php echo $category_title; ?>
                                    </option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No category found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" <?php if ($featured == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="featured" value="No" <?php if ($featured == "No") echo "checked"; ?>> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" <?php if ($active == "Yes") echo "checked"; ?>> Yes
                        <input type="radio" name="active" value="No" <?php if ($active == "No") echo "checked"; ?>> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Food" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        //upload image
        $image_name = $_FILES['image']['name'];
        //auto rename image
        $ext = end(explode('.', $image_name));
        $image_name = "Food" . rand(000, 999) . "." . $ext;
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/food/" . $image_name;
        //finally upload
        $upload = move_uploaded_file($source_path, $destination_path);
        //check the image is uploaded or not
        if ($upload == FALSE) {
            $_SESSION['upload-food'] = "<div class='error'>Failed to upload image</div>";
            header("Location:" . SITEURL . "admin/manage-food.php");
            die();
        } else {
            $_SESSION['upload'] = "<div class='success'>Upload image successfully</div>";
        }
    } else {
        //dont upload and save img values as blank
        $image_name = $current_image;
    }

    // SQL to update the food in the database
    $sql2 = "UPDATE food SET title='$title', description='$description', image_name='$image_name', price='$price', category_id='$category', featured='$featured', active='$active' WHERE id='$id'";
    // Execute query and update data in the database
    $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    if ($res2 == TRUE) {
        $_SESSION['update-food'] = "<div class='success'>Food updated successfully</div>";
        header("location:" . SITEURL . "admin/manage-food.php");
    } else {
        echo "<div class='error'>Failed to update food</div>";
        header("location:" . SITEURL . "admin/update-category.php");
    }
}
?>
