<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
    <title>Manage Order</title>
</head>
<body>
    <?php include('../admin/partials/menu.php') ?>
    <!--Main content section start-->
    <div class="main_content">
        <div class="wrapper">
            <h1>MANAGE ORDER</h1>
            <br><br>
            <?php

         
        if (isset( $_SESSION['delete-order'])) {
            echo  $_SESSION['delete-order'];
            unset( $_SESSION['delete-order']);
        }
        if (isset( $_SESSION['update-order'])) {
            echo  $_SESSION['update-order'];
            unset( $_SESSION['update-order']);
        }
        ?>
        <br>
            <table class="tbl-full">
                <tr>
                    <th>S.N</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Order</th>
                    <th>Order date</th>
                    <th>Status</th>
                    <th>Customer name</th>
                    <th>Customer contact</th>
                    <th>Customer Email</th>
                    <th>Customer address</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM `order`";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id=$row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $contact = $row['customer_contact'];
                        $email = $row['customer_email'];
                        $address = $row['customer_address'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $contact; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $address; ?></td>
                            <td>
                                <a href="update-order.php?id=<?php echo $id?>" class="btn-update">Update</a>
                                <a href="delete-order.php?id=<?php echo $id?>" class="btn-delete">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='12' class='error'>No orders found.</td></tr>";
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </table>
        </div>
    </div>
    <!--Main content section end-->

    <!--Footer section start-->
    <?php include('../admin/partials/footer.php') ?>
    <!--Footer section end-->
</body>
</html>
