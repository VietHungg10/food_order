<link rel="stylesheet" href="../css/admin.css?v= <?php echo time(); ?>">
<?php include "../admin/partials/menu.php" ?>
<div class="main_content ">
    <div class="wrapper">
        <h1> ADD ADMIN</h1>

        <br>
        
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>User name:</td>
                    <td><input type="text" name="user_name" placeholder="Enter user name"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td> <input type="password" name="password" placeholder="Enter  password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add admin" class="btn-add">
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
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = md5($_POST['password']); //Encrypt the password using md5

    //sql to insert into database
    $sql = "INSERT INTO admin (full_name, user_name, password) VALUES ('$full_name', '$user_name', '$password')";

    //execute query and save data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    //display if the data inserted of not
    if ($res == true) {
       $_SESSION["add"]= "<div class='success'>Admin added successfully</div>";
       header("Location:".SITEURL."admin/manage-admin.php"); 
    } else {
        $_SESSION["add"]= "<div class='error'>Failed to added admin</div>";
        header("Location:".SITEURL."admin/add-admin.php"); 
    }
}

