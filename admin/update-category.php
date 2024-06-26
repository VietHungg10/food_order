<link rel="stylesheet" href="../css/admin.css?v= <?php echo time(); ?>">
<?php include "../admin/partials/menu.php" ?>
<div class="main_content ">
    <div class="wrapper">
        <h1> UPDATE CATEGORY</h1>

        <br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // SQL query to get admin details
            $sql = "SELECT * FROM category WHERE id=$id";
            $res = mysqli_query($conn, $sql);

            // Check if the query was executed
            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    // Get the category data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    // Redirect to manage admin page with a session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
                    header("Location:" . SITEURL . "admin/manage-category.php");
                }
            }
        } else {
            header("Location:" . SITEURL . "admin/manage-admin.php");
        }
        ?>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title </td>
                    <td><input type="text" name="title" value=" <?php echo $title ?>"> </td>
                </tr>
                <tr>
                    <td>Current image</td>
                    <td><?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $current_image ?>" width="100px">
                        <?php
                        } else {
                            echo "<div class='error'>Image not added</div>";
                        }
                        ?>

                    </td>
                </tr>
                <tr>

                    <td>New image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td> <input <?php if ($featured == "Yes") {
                                    echo "Checked";
                                } ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") {
                                    echo "Checked";
                                } ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td> <input <?php if ($active == "Yes") {
                                    echo "Checked";
                                } ?> type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update category" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {
    // Get data from form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //updating new image
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        //upload image
        $image_name = $_FILES['image']['name'];
        //auto rename image
        if ($image_name != "") {

            $ext = end(explode('.', $image_name));
            $image_name = "Food_category" . rand(000, 999) . "." . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;
            //finally upload
            $upload = move_uploaded_file($source_path, $destination_path);
            //check the image is uploaded or not
            if ($upload == FALSE) {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                header("Location:" . SITEURL . "admin/manage-category.php");
                die();
            } else {
                $_SESSION['upload'] = "<div class='sucess'>Upload image sucessfully</div>";
                header("Location:" . SITEURL . "admin/manage-category.php");
            }
        }
    } else {
        //dont upload and save img values as blank
        $image_name = $current_image;
    }
    // SQL to update the admin in the database
    $sql2 = ("UPDATE category SET title='$title',image_name='$image_name',featured='$featured', active='$active' WHERE id='$id'");
    // Execute query and update data in the database
    $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    if ($res == TRUE) {
        $_SESSION['update-category'] = "<div class='success'>Category updated successfully</div>";
        header("location:" . SITEURL . "admin/manage-category.php");
    } else {
        echo "<div class='error'>Failed to update category</div>";
        header("location:" . SITEURL . "admin/update-category.php");
    }
}




?>


<?php include('../admin/partials/footer.php') ?>