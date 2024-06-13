<?php include('../php-project/partiels-front/menu.php') ?>
    <!-- Navbar Section Ends Here -->
<?php  
if(isset($_GET['food_id'])){
    $food_id=$_GET['food_id'];

    $sql ="SELECT * FROM food WHERE id='$food_id'";
    $res=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($res);

    if($count==1){
        $row=mysqli_fetch_assoc($res);
        $title=$row['title'];
        $price=$row['price'];
        $image_name=$row['image_name'];
    }
    else{
        header('location:'.SITEURL);
    }
}
else{
    header('location:'.SITEURL);
}
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php if ($image_name != "") { ?>
                            <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                        <?php } else { ?>
                            <div class="error">Image not added</div>
                        <?php } ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title ?></h3>
                        <p class="food-price"><?php echo $price ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>

<?php
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $qty = $_POST['qty'];
    $address = $_POST['address'];
    $total = $price * $qty;
    $order_date = date("Y-m-d h:i:sa");
    $status = "Ordered"; // ordered / on delivery / delivered / canceled
    
    $sql2 = "INSERT INTO `order` (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address)
             VALUES ('$title', '$price', '$qty', '$total', '$order_date', '$status', '$full_name', '$contact', '$email', '$address')";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        // Query executed successfully
        $_SESSION['order']="<div class='succes text-center'>Order placed successfully!</div>";
        header('location:'.SITEURL);
    } else {
        // Query execution failed
        $_SESSION['order']="<div class='error text-center'>Failed to place order.</div>";
        header('location:'.SITEURL);
    }
}
?>

<?php include('../php-project/partiels-front/footer.php'); ?>
