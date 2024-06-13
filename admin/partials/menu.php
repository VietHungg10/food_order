<!--Menu section start-->
<?php include('../config/constants.php') ?>
<?php include('login-check.php') ?>
<html>

<head>
    <h1>FOOD ORDER WEBSITE - HOMEPAGE</h1>
    <link rel="stylesheet" href="../css/admin.css?v= <?php echo time(); ?>">
    
</head>

<body>
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="../admin/manage-admin.php">Admin manager</a></li>
                <li><a href="../admin/manage-category.php">Category</a></li>
                <li><a href="../admin/manage-food.php">Food</a></li>
                <li><a href="../admin/manage-order.php">Order</a></li>
                <li><a href="../admin/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</body>


</html>