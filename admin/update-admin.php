<link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
<?php include "../admin/partials/menu.php"; ?>

<div class="main_content">
    <div class="wrapper">
        <h1>UPDATE ADMIN</h1>
        <br>
        <?php
        // Check if ID is set
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // SQL query to get admin details
            $sql = "SELECT * FROM admin WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            
            // Check if the query was executed
            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    // Get the admin data
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $user_name = $row['user_name'];
                } else {
                    // Redirect to manage admin page with a session message
                    $_SESSION['no-admin-found'] = "Admin not found.";
                    header("Location:".SITEURL."admin/manage-admin.php");
                }
            }
        } else {
            header("Location:".SITEURL."admin/manage-admin.php");
        }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>User name:</td>
                    <td><input type="text" name="user_name" value="<?php echo $user_name; ?>" placeholder="Enter user name"></td>
                </tr>
               
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update admin" class="btn-update">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Get data from form
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $user_name = $_POST['user_name'];
            
            // SQL to update the admin in the database
            $sql = "UPDATE admin SET full_name='$full_name', user_name='$user_name' WHERE id='$id'";

            // Execute query and update data in the database
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            // Display if the data was updated or not
            if ($res == true) {
                $_SESSION["update"] = "<div class='success'> Admin updated successfully</div>";
                header("Location:".SITEURL."admin/manage-admin.php");
            } else {
                $_SESSION["update"] = "Failed to update admin";
                header("Location:".SITEURL."admin/update-admin.php");
            }
        }
        ?>
    </div>
</div>
<?php include('../admin/partials/footer.php'); ?>
