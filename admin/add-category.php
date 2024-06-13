<link rel="stylesheet" href="../css/admin.css?v= <?php echo time(); ?>">
<?php include "../admin/partials/menu.php" ?>
<div class="main_content ">
    <div class="wrapper">
        <h1> ADD CATEGORY</h1>

        <br>

        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Category title"></td>
                </tr>
                <tr>
                    <td>Select image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td> <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td> <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>


    </div>
</div>
<?php include('../admin/partials/footer.php') ?>

<?php
//Data form to database

if (isset($_POST['submit'])) {
    //get data from form
    $title = $_POST['title'];
    $image = $_POST['image_name'];
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    } else {
        $featured = "No";
    }

    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    } else {
        $active = "No";
    }
    if (isset($_FILES['image']['name'])) {
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
                header("Location:" . SITEURL . "admin/add-category.php");
                die();
            } else {
                $_SESSION['upload'] = "<div class='sucess'>Upload image sucessfully</div>";
                header("Location:" . SITEURL . "admin/manage-category.php");
            }
        }
    } else {
        //dont upload and save img values as blank
        $image_name = "";
    }
    //sql to insert into database
    $sql = "INSERT INTO category (title,image_name, featured, active) VALUES ('$title','$image_name', '$featured', '$active')";

    //execute query and save data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    //display if the data inserted of not
    if ($res == true) {
        $_SESSION["add-category"] = "<div class='success'>Category added successfully</div>";
        header("Location:" . SITEURL . "admin/manage-category.php");
    } else {
        $_SESSION["add-category"] = "<div class='error'>Failed to added category</div>";
        header("Location:" . SITEURL . "admin/add-category.php");
    }
}
