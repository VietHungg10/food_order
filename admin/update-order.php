<?php 
// Start the session

include "../admin/partials/menu.php"; 
?>

<link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">

<div class="main_content">
    <div class="wrapper">
        <h1>UPDATE ORDER</h1>
       <?php
        // Check if id is set in the URL
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            // SQL query to get the order details
            $sql = "SELECT * FROM `order` WHERE id='$id'";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $count = mysqli_num_rows($res);
                if ($count > 0) {
                    // Fetch the order details
                    $row = mysqli_fetch_assoc($res);
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $contact = $row['customer_contact'];
                    $email = $row['customer_email'];
                    $address = $row['customer_address'];
                } else {
                    $_SESSION['error'] = "<div class='error'>Order not found</div>";
                    header("Location: " . SITEURL . "admin/manage-order.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "<div class='error'>Failed to execute query</div>";
                header("Location: " . SITEURL . "admin/manage-order.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "<div class='error'>Unauthorized access</div>";
            header("Location: " . SITEURL . "admin/manage-order.php");
            exit();
        }
       ?>

<form action="" method="post" enctype="multipart/form-data">
    <table class="tbl-30">
        <tr>
            <td>Food</td>
            <td><b><?php echo $food; ?></b></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><b><?php echo $price; ?></b></td>
        </tr>  
        <tr>
            <td>Quantity</td>
            <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <select name="status">
                    <option value="Ordered" <?php if($status=="Ordered") {echo "selected";} ?>>Ordered</option>
                    <option value="On delivery" <?php if($status=="On delivery") {echo "selected";} ?>>On delivery</option>
                    <option value="Delivered" <?php if($status=="Delivered") {echo "selected";} ?>>Delivered</option>
                    <option value="Cancelled" <?php if($status=="Cancelled") {echo "selected";} ?>>Cancelled</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Customer name</td>
            <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
        </tr>
        <tr>
            <td>Customer contact</td>
            <td><input type="text" name="customer_contact" value="<?php echo $contact; ?>"></td>
        </tr>
        <tr>
            <td>Customer email</td>
            <td><input type="text" name="customer_email" value="<?php echo $email; ?>"></td>
        </tr>
        <tr>
            <td>Customer address</td>
            <td><input type="text" name="customer_address" value="<?php echo $address; ?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update order" class="btn-add">
            </td>
        </tr>
    </table>
</form>

<?php
if(isset($_POST['submit'])){
    // Get the updated values
    $qty = $_POST['qty'];
    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $contact = $_POST['customer_contact'];
    $email = $_POST['customer_email'];
    $address = $_POST['customer_address'];
    
    // Update the order details
    $sql2 = "UPDATE `order` SET 
                qty='$qty',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$contact',
                customer_email='$email',
                customer_address='$address' 
             WHERE id='$id'";
    
    $res2 = mysqli_query($conn, $sql2);
    
    if($res2 == TRUE){
        $_SESSION['update-order'] = "<div class='success'>Order updated successfully</div>";
        header("Location: " . SITEURL . "admin/manage-order.php");
    } else {
        $_SESSION['update-ỏder'] = "<div class='error'>Failed to update order</div>";
        header("Location: " . SITEURL . "admin/update-order.php?id=$id");
    }
}
?>
    </div>
</div>
