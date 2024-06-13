<link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
<?php include "../admin/partials/menu.php"; ?>
<div class="main_content">
    <div class="wrapper">
        <h1>CHANGE PASSWORD</h1>
        <?php
        // Check if ID is set
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        $password = '';
        ?>

        <br>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Your Password:</td>
                    <td><input type="password" name="your_password" value="<?php echo $password; ?>" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" value="<?php echo $password; ?>" placeholder="Enter your new password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" value="<?php echo $password; ?>" placeholder="Confirm your password"></td>
                </tr>


                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-add">
                    </td>
                </tr>
            </table>
        </form>
        <?php
       if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $current_password = md5($_POST['your_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
    
            //check the user with current id and password is exist or not
            $sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password'";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    if ($new_password==$confirm_password) {
                       $sql2 ="UPDATE admin SET password='$new_password' WHERE id=$id";
                       $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                       if($res==TRUE){
                        $_SESSION['change-pw'] = "<p class='success'>Password changed successfully</p>";
                        header("Location:" . SITEURL . "admin/update-admin.php");
                       }
                       else{
                        $_SESSION['change-pw'] = "<p class='error'>Failed to change password</p>";
                        header("Location:" . SITEURL . "admin/update-admin.php");
                       }
                    }

                    else{
                        $_SESSION["pw-not-match"] = "<div class='error'> Password not match</div>";
                        if (isset($_SESSION["pw-not-match"])) {
                            echo $_SESSION["pw-not-match"];
                            unset($_SESSION["pw-not-match"]);
                        };




                         
                    }
                   
                } else {
                    $_SESSION["user-not-found"] = "<div class='error'> Wrong password</div>";
                    if (isset($_SESSION["user-not-found"])) {
                        echo $_SESSION["user-not-found"];
                        unset($_SESSION["user-not-found"]);
                    };
                   
                }
                //check new password is match or not

                //change password if all above true




            }
        }
        ?>




    </div>
</div>
















 




<?php include('../admin/partials/footer.php'); ?>;