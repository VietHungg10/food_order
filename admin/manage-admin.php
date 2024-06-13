<link rel="stylesheet" href="../css/admin.css?v= <?php echo time(); ?>">
<?php include('..//admin/partials/menu.php') ?>
<!--Main content section start-->
<div class="main_content ">
    <div class="wrapper">

        <h1> MANAGE ADMIN</h1>
       
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        };
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        };
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        };
        if (isset($_SESSION["user-not-found"])) {
            echo $_SESSION["user-not-found"];
            unset($_SESSION["user-not-found"]);
        };
        if (isset($_SESSION["pw-not-match"])) {
            echo $_SESSION["pw-not-match"];
            unset($_SESSION["pw-not-match"]);
        };
        if (isset($_SESSION["change-pw"])) {
            echo $_SESSION["change-pw"];
            unset($_SESSION["change-pw"]);
        };
        
        ?> <br><br>
        <a href="../admin/add-admin.php" class="btn-add">Add Admin</a>
        <br><br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Fullname</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php
            $sql = "SELECT * FROM admin";
            $res = mysqli_query($conn, $sql);
            $sn =1;
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['user_name'];
            ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $full_name ?> </td>
                            <td><?php echo $username ?> </td>
                            <td>
                                <a href="<?php echo SITEURL . 'admin/update-admin.php?id=' . $id; ?>"  class="btn-update">Update</a>
                                <a href="<?php echo SITEURL . 'admin/delete-admin.php?id=' . $id; ?>" class="btn-delete">Delete</a>
                                <a href="<?php echo SITEURL . 'admin/change-password.php?id=' . $id; ?>"  class="btn-add">Change Password</a>
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

<!--Footer section end-->