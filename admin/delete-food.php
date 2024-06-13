<?php
include('../config/constants.php');
// get the id and image name
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    // Check if the image exists and remove it
    if ($image_name != "") {
        $path = ("../images/food/") . $image_name;
        $remove = unlink($path);
        if ($remove == false) {
            $_SESSION['remove-food'] = "<div class='error'>Failed to delete image from food</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die();
        }
    }
}
$sql = "DELETE FROM food WHERE id='$id'";
$res = mysqli_query($conn, $sql);
if($res==TRUE){
    $_SESSION["delete-food"] = "<div class='success'>Food deleted successfully</div>";
    header("Location:" . SITEURL . "admin/manage-food.php");
}
else{
    $_SESSION["delete-food"] = "<div class='error'>Failed to delete food</div>";
    header("Location:" . SITEURL . "admin/manage-food.php");
}


