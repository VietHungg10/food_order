<?php include('../config/constants.php') ?>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="../css/admin.css?v= <?php echo time(); ?>">
<!DOCTYPE html>
<html>

<head>
	<title> Login Page</title>

</head>


<body>
	 <form action="" method="post">
            <table class="tbl-30">
              
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
                        <input type="submit" name="submit" value="Login" class="btn-add">
                    </td>
                </tr>
            </table>
        </form> 
</body>

</html>

<?php
if (isset($_POST['submit'])) {
	$username = $_POST['user_name'];
	$password = md5($_POST['password']);
	$sql = "SELECT * FROM admin WHERE user_name='$username' AND password='$password'";
	$res = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($res);
	if ($count == 1) {

		$_SESSION['login'] = "<p class='success'>Login successfully</p>";
		$_SESSION['user'] = $username;
		setcookie("username", $username, time() + (86400 * 30), "/");
		header("Location:" . SITEURL . "admin/");
	} else {
		$_SESSION["login"] = "<div class='error'> Failed to login</div>";
	}
}
$conn->close();
if (isset($_SESSION['login'])) {
	echo $_SESSION['login'];
	unset($_SESSION['login']);
}
if (isset($_SESSION['need-login'])) {
	echo $_SESSION['need-login'];
	unset($_SESSION['need-login']);
};
?>