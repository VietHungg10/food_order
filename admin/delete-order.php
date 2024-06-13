<?php
include('../config/constants.php');

if(isset($_GET['id'])){
    $id=$_GET['id'];
}

$sql="DELETE  FROM `order` WHERE id='$id'";
$res=mysqli_query($conn,$sql);
if($res==TRUE){
    $_SESSION['delete-order']="<div class='success'>Delete order successfully</div>";
    header('location:'.SITEURL.'admin/manage-order.php');
}
else{
    $_SESSION['delete-order']="<div class='error'>Failed to delete order </div>";
    header('location:'.SITEURL.'manage_order.php');
}