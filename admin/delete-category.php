<?php
include('../config/constants.php');



if (isset($_GET['id']) && isset($_GET['image_name'])) {
    // get the id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Check if the image exists and remove it
    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        $remove = unlink($path);

        // Check if the image was successfully removed
        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>Failed to delete image from category</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            die();
        }
    }

    // SQL query to delete the category
    $sql = "DELETE FROM category WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if ($res == true) {
        $_SESSION["delete-category"] = "<div class='success'>Category deleted successfully</div>";
        header("Location:" . SITEURL . "admin/manage-category.php");
    } else {
        $_SESSION["delete-category"] = "<div class='error'>Failed to delete category</div>";
        header("Location:" . SITEURL . "admin/manage-category.php");
    }
}

    // Redirect to manage category page
