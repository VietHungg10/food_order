<link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
<?php include "../admin/partials/menu.php"; ?>
<div class="main_content">
    <div class="wrapper">
        <h1> ADD FOOD</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Food title"></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><input type="text" name="description"></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select image:</td>
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
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
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
<?php

if (isset($_POST['submit'])) {
    // Kết nối đến cơ sở dữ liệu
    include('../config/constants.php'); // Đảm bảo bạn đã bao gồm tệp cấu hình chứa thông tin kết nối

    // Lấy dữ liệu từ form
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
    $active = isset($_POST['active']) ? $_POST['active'] : "No";

    // Xử lý hình ảnh
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = "Food_" . rand(000, 999) . "." . $ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == FALSE) {
                $_SESSION['upload-food'] = "<div class='error'>Failed to upload image</div>";
                header("Location:" . SITEURL . "admin/add-food.php");
                die();
            }
        }
    } else {
        $image_name = "";
    }

    // Chèn dữ liệu vào bảng 'food'
    $sql = "INSERT INTO food (title, description, price, image_name, category_id, featured, active) 
            VALUES ('$title', '$description', '$price', '$image_name', '$category', '$featured', '$active')";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if ($res == TRUE) {
        $_SESSION["add-food"] = "<div class='success'>Food added successfully</div>";
        header("Location:" . SITEURL . "admin/manage-food.php");
    } else {
        $_SESSION["add-food"] = "<div class='error'>Failed to add food</div>";
        header("Location:" . SITEURL . "admin/add-food.php");
    }
}
?>
<?php include('../admin/partials/footer.php'); ?>
