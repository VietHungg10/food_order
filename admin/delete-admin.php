<?php
include('../config/constants.php');
// get id to delete
 $id = $_GET['id'];
 //sql query to delete
$sql = "DELETE FROM admin WHERE id=$id";
//excute the query
$res =mysqli_query($conn,$sql);
//check if the query is successfully
if($res==true) {
    $_SESSION["delete"]= "<div class='success'> Admin deteled successfully </div>";
       header("Location:".SITEURL."admin/manage-admin.php"); 
}
else{
    $_SESSION["add"]= "<div class='error'></div>Failed to delete Admin";
    header("Location:".SITEURL."admin/manage-admin.php"); 
}
?>